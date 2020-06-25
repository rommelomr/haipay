@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
	<link rel="stylesheet" href="{{asset('css/payments/verify_payments.css')}}">    
	<style>
		.card .card-image .card-title {
			right:0;
			top:0;
			left:auto;
		}
	</style>
@endsection

@section('main')

	<div class="container-fluid" style="padding:2%">
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<div class="row">
						<div class="col s12">
							<center>
								<h5>{{$title}}</h5>
							</center>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<center>
								<a href="{{route('verify_payments')}}" 
									@if($selected_button == 0)
										disabled 
									@endif 
								class="btn btn-small indigo tooltipped" data-position="top" data-tooltip="Verify payments"><i class="material-icons">camera_alt</i></a>

								<a href="{{route('waiting_payments')}}"
									@if($selected_button == 1)
										disabled
									@endif
								class="btn btn-small orange tooltipped" data-position="top" data-tooltip="Payments waiting for approval"><i class="material-icons">access_time</i></a>
								<a href="{{route('approved_payments')}}"
									@if($selected_button == 2)
										disabled
									@endif
								class="btn btn-small green tooltipped" data-position="top" data-tooltip="Approved payments"><i class="material-icons">check</i></a>
								<a href="{{route('canceled_payments')}}"
									@if($selected_button == 3)
										disabled
									@endif
								class="btn btn-small red tooltipped" data-position="top" data-tooltip="Not approved payments"><i class="material-icons">cancel</i></a>
							</center>
						</div>
					</div>
					<div class="row">
						@if($compras[0]!=null)
							<div class="col s12 l6">
								<div class="card-panel">
									<div class="row">
										<div class="col s12">
											<b>Pursache's Number: </b><span id="span_transaction">{{$compras[0]->transaccion->id}}</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col s10 offset-s1">
											<div class="card">
												<div class="card-image">
													@if( $selected_button != 0)
													<img id="imagen" class="responsive-img materialboxed" 
														src="{{Storage::url('public/'.$compras[0]->transaccion->imagen->nombre)}}"
													>
													@else
													<img class="responsive-img" 
														src="{{asset('images/pay.png')}}"
													>
													@endif
												</div>
												@if(($selected_button == 0 || $selected_button == 3))
													<a href="#modal_send_images" class="modal-trigger btn-floating halfway-fab orange"><i class="material-icons">add</i></a>
												@endif
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col s10 offset-s1">
											<table class="striped">
												<tr>
													<th>Pursache</th>
													<td><span id="monto">{{$compras[0]->monto}}</span> <span class="buy">{{$compras[0]->haiCriptomoneda->moneda->siglas}}</span></td>
												</tr>
												<tr>
													@php
														$price = $compras[0]->precio_moneda_a_comprar + ($compras[0]->precio_moneda_a_comprar * ($compras[0]->comision_general/100)) + ($compras[0]->precio_moneda_a_comprar * ($compras[0]->comision_compra/100))
													@endphp
													<th><span class="buy">{{$compras[0]->haiCriptomoneda->moneda->siglas}}</span> Cost</th>
													<td><span id="precio">{{$price}}</span> <span class="pay">USD</span></td>
												</tr>
												<tr>
													<th>To pay</th>
													<td><span id="total">{{$compras[0]->total_con_comision}}</span> <span class="pay">{{$compras[0]->moneda->siglas}}</span> </td>
												</tr>
												
											</table>

										</div>
									</div>
								</div>
							</div>
							<div class="col s12 l6">

								<ul class="collection">
									@forelse($compras as $compra)

									<li class="collection-item"
										@if($selected_button == 0)
											data-tiene_imagen="0"
										@else
											data-tiene_imagen="1"
										@endif

										data-transaction="{{$compra->transaccion->id}}"

										data-monto="{{$compra->monto}}"
										data-total="{{$compra->total_con_comision}}"
										data-buy="{{$compra->haiCriptomoneda->moneda->siglas}}"
										data-pay="{{$compra->moneda->siglas}}"
										@if($compra->transaccion->imagen != null)
											data-image="{{Storage::url('public/'.$compra->transaccion->imagen->nombre)}}"
										@else
											data-image="{{asset('images/pay.png')}}"
										@endif
										@php
											$price = $compra->precio_moneda_a_comprar + ($compra->precio_moneda_a_comprar * ($compra->comision_general/100)) + ($compra->precio_moneda_a_comprar * ($compra->comision_compra/100))
										@endphp
										data-price="{{$price}}"
										>
										#{{$compra->transaccion->id}}
										<span class="badge">{{$compra->monto}} {{$compra->haiCriptomoneda->moneda->siglas}}</span>
									</li>
									@empty
									@endforelse
								</ul>
								<center>
									{{$compras->links('commons.pagination',[
										'paginate' => $compras,
										'max_buttons' => 10
									])}}
								</center>
							</div>
						@else
						<div class="col s10 offset-s1">
							<div class="card">
								<div class="card-image">
									<img src="{{asset('images/vacio.jpg')}}" class="responsive-img">										
									<span class="card-title white-text">There's no transactions to show</span>
								</div>
								
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
	@if(($selected_button == 0 || $selected_button == 3) && $compras[0]!=null)	
	<div id="modal_send_images" class="modal">
		<div id="modal-content" class="modal-content margin-0">
			<center><h5 id="modal-title">Send the verification image</h5></center>
		<form id="verificaction_form" method="POST" enctype="multipart/form-data"
		@if($selected_button == 0)
			action="{{route('verify_transaction')}}"
		@elseif($selected_button == 3)
			action="{{route('resend_image')}}"
		@endif

		>@csrf
			<input class="transaction" name="id_transaction" value="{{$compras[0]->transaccion->id}}" hidden>
			<br>
			<div class="row">
				<div class="col s12">
					<center>
						<input type="file" class="browser-default" name="file"><br><br>
						<button class="btn green">Send</button>
						<div class="btn red lighten-2 modal-close">Close</div>
					</center>
				</div>
			</div>
		</form>
		</div>
	</div>
	@endif
@endsection
<script>
	document.addEventListener('DOMContentLoaded', function() {
 		let elem_modal = document.querySelectorAll('.modal');
    	let instances_modal = M.Modal.init(elem_modal);

 		var elems_materialboxed = document.querySelectorAll('.materialboxed');
    	var instances = M.Materialbox.init(elems_materialboxed);

		var elems_tooltip = document.querySelectorAll('.tooltipped');
    	var instances = M.Tooltip.init(elems_tooltip);

		@if(session('messages'))
			@foreach(session('messages') as $messages)
			  M.toast({html: '{{$messages}}'})
			@endforeach

		@endif
		
		@if ($errors->any())
            @foreach ($errors->all() as $error)
	  			M.toast({html: '{{ $error }}'})
            @endforeach
		@endif

    });
</script>
<script type="module" src="{{asset('js/payments/verify.js')}}"></script>
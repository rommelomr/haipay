@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
	<link rel="stylesheet" href="{{asset('css/remittances/main.css')}}">
	<style>
		.card .card-image .card-title {
			right:0;
			top:0;
			left:auto;
		}
	</style>    
@endsection
@section('main')
	<div class="container-fluid" style="padding: 2%;">
		<div class="card-panel">
			<div class="row">
				<div class="col s12">
					<h5 class="center">{{$title}}</h5>
				</div>
			</div>
		  	<div class="row">
	    		<div class="col s12">
					<center>
						<a href="{{route('verify_remittances')}}"
							@if($selected_button == 0)
								disabled
							@endif
							class="btn btn-small indigo tooltipped"
							data-position="top"
							data-tooltip="Verify payments">

							<i class="material-icons">camera_alt</i>

						</a>

						<a href="{{route('waiting_remittances')}}"
							@if($selected_button == 1)
								disabled
							@endif
							class="btn btn-small orange tooltipped"
							data-position="top"
							data-tooltip="Payments waiting for approval">
							<i class="material-icons">access_time</i>
						</a>
						<a href="{{route('approved_remittances')}}"
							@if($selected_button == 2)
								disabled
							@endif
							class="btn btn-small green tooltipped"
							data-position="top"
							data-tooltip="Approved payments">
							<i class="material-icons">check</i>
						</a>
						<a href="{{route('canceled_remittances')}}"
							@if($selected_button == 3)
								disabled
							@endif
							class="btn btn-small red tooltipped"
							data-position="top"
							data-tooltip="Not approved payments">
							<i class="material-icons">cancel</i>
						</a>
					</center>
	    		</div>
	    	</div>
	    	@if(count($remesas)>0)
				<div class="row">
					<div class="col s6">
						<div class="card-panel">
							<div class="row">
								<div class="col s12">
									<b>Remmittance # {{$remesas[0]->id}}</b>
								</div>
	    					</div>
							<div class="row">
								
				    			<div class="card">
									<div class="card-image">
										@if( $selected_button != 0)
										<img id="imagen" class="responsive-img materialboxed" 
											src="{{Storage::url('public/'.$remesas[0]->transaccion->imagen->nombre)}}"
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
							<div class="row">
								<div class="col s12">
									<table class="stripped">
										<tr>
											<th>Amount</th>
											<td id="amount">{{$remesas[0]->monto}}$</td>
										</tr>
										<tr>
											<th>Receiver's ID</th>
											<td id="receiver-id">
												@if($remesas[0]->remesaInterna != null)
													{{$remesas[0]->remesaInterna->cliente->usuario->persona->cedula}}
												@else
													{{$remesas[0]->remesaExterna->noUsuario->persona->cedula}}
												@endif
											</td>
										</tr>
										<tr>
											<th>Receiver's name</th>
											<td id="receiver-name">
												@if($remesas[0]->remesaInterna != null)
													{{$remesas[0]->remesaInterna->cliente->usuario->persona->nombre}}
												@else
													{{$remesas[0]->remesaExterna->noUsuario->persona->nombre}}
												@endif
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col s6">
						<div class="row">
							<div class="col s12">
								<ul class="collection">
									@foreach($remesas as $remesa)
										<li class="collection-item clickable_row"
											data-id_transaction="{{$remesa->transaccion->id}}"
											data-amount="{{$remesa->monto}}"

											@if($remesa->remesaInterna != null)
												data-receiver_id="{{$remesa->remesaInterna->cliente->usuario->persona->cedula}}"
											@else
												data-receiver_id="{{$remesa->remesaExterna->noUsuario->persona->cedula}}"
												
											@endif

											@if($remesa->remesaInterna != null)
												data-receiver_name="{{$remesa->remesaInterna->cliente->usuario->persona->nombre}}"
											@else
												data-receiver_name="{{$remesa->remesaExterna->noUsuario->persona->nombre}}"
											@endif

										>
											{{$remesa->monto}}$ to
											@if($remesa->remesaInterna != null)
												{{$remesa->remesaInterna->cliente->usuario->persona->nombre}}
											@else
												{{$remesa->remesaExterna->noUsuario->persona->nombre}}
											@endif
										</li>
									@endforeach

									<center>
										{{$remesas->links('commons.pagination',[
											'paginate' => $remesas,
											'max_buttons' => 10
										])}}
									</center>
								</ul>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="row">
					<div class="col s12">
						<div class="col s10 offset-s1">
							<div class="card">
								<div class="card-image">
									<img src="{{asset('images/vacio.jpg')}}" class="responsive-img">										
									<span class="card-title white-text">There's no transactions to show</span>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
	
@if(($selected_button == 0 || $selected_button == 3) && $remesas[0]!=null)	
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
			<input class="transaction" name="id_transaction" value="{{$remesas[0]->transaccion->id}}" hidden>
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
<script type="module" src="{{asset('js/remittances/verify.js')}}"></script>
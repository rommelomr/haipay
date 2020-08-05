@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')

	<div class="container-fluid" style="margin:2%;">
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<div class="row">
						<div class="col s12">
							<center>
								<h5>Witdrawals</h5>
							</center>
						</div>
					</div>
					<div class="row">
						@if($see)
						<div class="col s6">
							
							<div class="row">
								
								<div class="col s12">
									
									<table>
										<tr>
											<th>Name</th>
											<td>{{$retiro_actual->cliente->usuario->persona->nombre}}</td>
										</tr>
										<tr>
										</tr>
										<tr>
											<th>Amount</th>
											<td>{{$retiro_actual->monto_a_retirar}} {{$retiro_actual->haiCriptomoneda->moneda->siglas}}</td>
										</tr>
										<tr>
											<th>Withdraw method</th>
											<td>{{$retiro_actual->metodoRetiro->nombre}}</td>
										</tr>
										@if($retiro_actual->metodo_retiro == 3)
											<tr>
												<th>Adress</th>
												<td>{{$retiro_actual->direccion}}</td>
											</tr>
											<tr>
												<th>Tag</th>
												<td>{{$retiro_actual->tag}}</td>
											</tr>

										@else
											<tr>
												<th>Telephone</th>
												<td>
													@if($retiro_actual->cliente->usuario->telefono !== null)
														{{$retiro_actual->cliente->usuario->telefono}}
													@else
														Don't setted
													@endif
												</td>
											</tr>
											<tr>
												<th>Amount to send</th>
												<td>{{$monto_a_enviar}} HTG</td>
											</tr>
										@endif
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<center>
										<a href="#complete-modal" class="btn green modal-trigger">
											Complete
										</a>
									</center>
								</div>
							</div>
						</div>
						@else
							<div class="col s6">
								<center>
									<label>Select a withdraw</label>
								</center>
							</div>
						@endif
						<div class="col s6">
							<ul class="collection">
								@forelse($retiros as $retiro)
									<li class="collection-item">
										{{$retiro->cliente->usuario->persona->nombre}} <label>{{$retiro->created_at}}</label>
										<span class="badge">
											<a href="{{route('see_withdrawal',$retiro->id)}}">see</a>
										</span>
									</li>
								@empty
									There's no witdrawals for complete
								@endforelse
							</ul>
							<center>
								{{$retiros->links('commons.pagination',[
									'paginate' => $retiros,
									'max_buttons' => 10
								])}}
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@if($see)
	<div id="complete-modal" class="modal">
		<div class="modal-content">
			Do you really want to complete this withdraw now?
		</div>
		<form action="{{route('complete_withdraw')}}" method="post" hidden>
			@csrf
			<input type="text" name="id_retiro" value="{{$retiro_actual->id}}">
			<input type="submit" id="input-submit">
		</form>
		<div class="modal-footer">
			<label for="input-submit" class="btn green modal-close">Yes</label>
			<button class="btn red modal-close">No</button>
		</div>
	</div>
@endif
@endsection
<script src="{{asset('js/withdrawals_mod/materialize.js')}}"></script>
<script type="module">

	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/withdrawals/Methods.js')}}";

	window.addEventListener('load',function(){

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

@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/dash_clients.css')}}">
@endsection
@section('main')
    <div class="container-fluid">
    	
        <div class="row">
		    <div class="col s12">
				<div class="row"><br>
					<div class="col s6">
						<center>
							<div class="row">
								@foreach($criptomonedas as $criptomoneda)
								<div class="card-cripto col s12 l6">
									<div class="card">
										<div class="card-content">
											<b>{{$criptomoneda->moneda->siglas}}</b><br>
											<span class="precio-{{$criptomoneda->moneda->siglas}}-USD">cargando</span> $
										</div>
										<div class="card-action">
											<div class="row" style="margin:0">
												<div class="col s6">
													<center>
														<a href="{{route('buy_crypto',$criptomoneda->moneda->siglas)}}" class="tooltipped" data-position="top" data-tooltip="Buy">
															<i class="material-icons" style="color:green">add_shopping_cart</i>
														</a>
													</center>
												</div>
												<div class="col s6">
													<center>
														<a href="{{route('trade',$criptomoneda->moneda->siglas)}}" class="tooltipped" data-position="top" data-tooltip="Trade"><i class="material-icons">autorenew</i></a>
													</center>
												</div>

											</div>
										</div>
									</div>
								</div>


								@endforeach
							</div>
						</center>
					</div>
					<div class="col s6">
						<div class="card-panel">
							<h5 class="center">My criptos</h5>
							<hr>
							<ul class="collection">
						    	@forelse($carteras as $cartera)
									<li class="collection-item">
										{{$cartera->haiCriptomoneda->moneda->nombre}}
										<a href="{{route('dashboard_clients')}}"><span class="badge new green" data-badge-caption="Buy more"></span></a>
										<span class="badge">{{$cartera->cantidad}}</span>
									</li>
								@empty
									You haven't bought cryptos yet
								@endforelse
							</ul>
						</div>
					</div>
					
				</div>
		    </div>
        </div>
    </div>
@endsection
<script>

	document.addEventListener('DOMContentLoaded', function() {

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
		let elems_tooltip = document.querySelectorAll('.tooltipped');
    	let instances = M.Tooltip.init(elems_tooltip);
	});

</script>
<script type="module">
	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/dashboard/Methods.js')}}";
	D.dom.load(function(){

		let comision_general 	= JSON.parse(Me.htmlDecode("{{$comision_general}}"));

		let info_criptos 		= JSON.parse(Me.htmlDecode("{{$info_cryptos}}"));

		Me.launchWsConsult(info_criptos,comision_general);
	});
	
</script>
<script src="{{asset('js/verify_payment/main.js')}}" type="module"></script>
@extends('layouts.buy')

@section('card')
	<div class="card-panel">
		<div class="row">
			<div class="col s12">
				<center>
					<h5>Deposit {{$criptomoneda->moneda->nombre}}</h5>
				</center>
			</div>
		</div>
		<form action="{{route('send_deposit')}}" method="post" enctype="multipart/form-data">
			@csrf
			<input type="text" value="{{$criptomoneda->id}}" hidden name="hai_crypto_id">
			<div class="row">
				<div class="input-field col s12">
					<label for="url">Public transaction URL</label>
					<input id="url" type="text" name="url">
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<center>
						<span class="helper-text">Image</span>
						<input id="comission" type="file" name="image">
					</center>
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					<center>
						<button class="btn green">Deposit</button>
					</center>
				</div>			
			</div>
		</form>
		<!--div class="card-action">
			<div class="row" style="margin:0">
				<div class="col s6">
					<center>
						<b>Crypto:</b> {{$criptomoneda->moneda->nombre}}
					</center>
				</div>
				<div class="col s6">
					<center>
						<b>Price:</b> <span class="real-time-price">cargando</span>$
					</center>
				</div>
			</div>
		</div-->
	</div>
<div hidden>
	<input id="real-time-price">
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
		//let elems_tooltip = document.querySelectorAll('.tooltipped');
    	//let instances = M.Tooltip.init(elems_tooltip);
	});
</script>
<script type="module">
/*
	import {D} from "{{asset('js/Domm/Domm.js')}}";

	import {Me} from "{{asset('js/buy_crypto/deposit.js')}}";

	document.addEventListener('DOMContentLoaded', function() {

		let current_crypto = [];
		current_crypto['siglas'] = "{{$criptomoneda->moneda->siglas}}";
		current_crypto['url'] = "{{$criptomoneda->origen->url}}";
		let comision_general = "{{$comisiones['general']['porcentaje']}}";
		let comision_deposito = "{{$comisiones['deposit']['porcentaje']}}";
		
		Me.launchWsConsult(current_crypto,comision_deposito,comision_general);

		D.addEvent.onKeyUp('#amount',function(el){

			Me.calculateComission(comision_deposito);

		})

	});
*/
	
</script>
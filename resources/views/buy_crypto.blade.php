@extends('layouts.buy')

@section('card')
	<div class="card-panel">
		<center>
			<h5>Buy Crypto</h5>
		</center>
		<hr>

		<div class="row">
			<div class="col s6">
				<input autocomplete="off" type="number" id="amount" value="{{old('amount')}}">
				<span class="helper-text">Amount</span>
			</div>
			<div class="col s6">
				<select name="" id="type_operation" class="browser-default">
					<option value="" disabled selected>Payment Method</option>
					@foreach($metodos_pago as $metodo_pago)

						<option
						@if(old('type_operation') == $metodo_pago->id)
							selected
						@endif
						value="{{$metodo_pago->id}}">{{$metodo_pago->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<input id="to-pay" type="text" value="{{old('to_pay')}}" disabled class="dependent-amount">
				<span class="helper-text">To pay in USD</span><br>
				<span id="amount-error" hidden class="helper-text red-text">The amount to pay can't be over 1000$ or under 0.0001$</span>
			</div>
			<div class="col s6">
				<center>
					<a id="buy_button" href="#modal_confirm" disabled class="btn green modal-trigger">Buy</a>
				</center>
			</div>
		</div>

		<div class="card-action">
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
		</div>
	</div>
@endsection
@section('js')
<script>
	
  document.addEventListener('DOMContentLoaded', function() {
    var elems_modal = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems_modal);

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

<script type="module">
	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/buy_crypto/Methods.js')}}";
	D.dom.load(function(){
		let current_crypto = [];

			current_crypto['url'] = "{{$criptomoneda->origen->url}}";
			current_crypto['siglas'] = "{{$criptomoneda->moneda->siglas}}";

		let comisiones = [];
			comisiones['general'] = {{$comision_general}};
			comisiones['compra'] = JSON.parse(Me.htmlDecode("{{$comisiones_compra}}"));

		Me.launchWsConsult(current_crypto,comisiones);
	
		D.addEvent.onKeyUp('#amount',function(e){

			let to_pay = Me.setToPay(comisiones);

			Me.setBuyButton(e,to_pay);

			Me.setAmountForm(e);

		});

		D.addEvent.onChange('#type_operation',function(e){

			let to_pay = Me.setToPay(comisiones);

			Me.setBuyButton(e,to_pay);

			Me.setTypeOperationForm(e);

		});

	});


</script>
<script type="module" src="{{asset('js/buy_crypto/main.js')}}"></script>

@endsection

@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
    <style>

    </style>
@endsection
@section('main')

	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<center>
						<h5>Buy Crypto</h5>
					</center>
					<hr>

					<div class="row">
						<div class="col s6">
							<input type="number" id="amount" value="{{old('amount')}}">
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
							<span class="helper-text">To Pay</span>
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
			</div>
		</div>
	</div>
<div id="modal_confirm" class="modal">
    <div class="modal-content">
    	<div class="row">
    		<div class="col s12">
    			<center>
    				<h5>Are you sure you want to buy now?</h5>
    			</center>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
    	<label for="send_submit" class="btn green">Buy</label>
    	<button class="btn red">Cancel</button>
    </div>
</div>        
<input id="save-price" hidden>
<form action="{{route('buy_crypto_post')}}" method="post" hidden>
	@csrf
	<input id="send_amount" name="amount">
	<input id="base" name="base" value="{{$criptomoneda->id}}">
	<input id="send_type_operation" name="type_operation">
	<input id="send_submit" type="submit">
</form>
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
@endsection
<script type="module">
	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/buy_crypto/Methods.js')}}";
	D.dom.load(function(){
		let current_crypto = [];

			current_crypto['url'] = "{{$criptomoneda->origen->url}}";
			current_crypto['siglas'] = "{{$criptomoneda->moneda->siglas}}";

		let comisiones = [];
			comisiones['general'] = {{$comisiones['general']}};
			comisiones['compra'] = {{$comisiones['compra']}};

		Me.launchWsConsult(current_crypto,comisiones);
	});

	let price_crypto = {{$precio}};

</script>
<script type="module" src="{{asset('js/buy_crypto/main.js')}}"></script>

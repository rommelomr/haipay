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
			<div class="col s12 l6">
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
								<a id="button_calculate" class="btn indigo">Add to car</a>
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
									<b>Price:</b> {{$precio}}$
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col s12 l6">
				<div class="card-panel">
					<center>
						<h5>Details</h5>
					</center>
					<hr>
					<div class="row">
						<div class="col s12">
							<center>
								You must pay <b><span id="to-pay-text">0</span> $</b> to receive <span id="i-will-recieve-text">0</span> {{$criptomoneda->moneda->nombre}}
							</center>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<center>
								<label id="buy_button" for="submit" class="green btn" disabled>Buy</label>
							</center>
						</div>
					</div>
					<form action="{{route('buy_crypto_post')}}" method="post" hidden>
						@csrf
						<input type="text" name="amount" id="form-amount" class="dependent-amount" value="{{old('amount')}}">
						<input type="text" name="base" value="{{$criptomoneda->id}}" value="{{old('base')}}">
						<input type="text" name="type_operation" id="form-type-operation" value="{{old('type_operation')}}">
						<input type="text" name="to_pay" id="form-to-pay" value="{{old('to_pay')}}">
						<input id="submit" type="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
<div id="calculadora" class="modal">
    <div class="modal-content">
    	<center>
    		<h4>Calculator</h4>
    	</center>
    	<div class="row">

    		<div class="col s6">
    			<fieldset>

    				<legend>Calculate by payment</legend>
					    <div class="input-field">
					      <input id="if-i-pay" type="text">
					      <span class="helper-text">If I pay ($)</span>
					    </div>
					    <center>
					    	<button class="btn indigo"><i class="material-icons">refresh</i></button>
					    </center>
					    <div class="input-field">
					      <input id="i-will-recieve" type="text">
					      <span class="helper-text">I will recieve ({{$criptomoneda->moneda->nombre}})</span>
					    </div>
    			</fieldset>
			</div>
    		

    		<div class="col s6">
    			<fieldset>
    				<legend>Calculate by receivement</legend>
					    <div class="input-field">
					      <input type="text">
					      <span class="helper-text">If I want to receive ({{$criptomoneda->moneda->nombre}})</span>
					    </div>
					    <center>
					    	<button class="btn indigo"><i class="material-icons">refresh</i></button>
					    </center>
					    <div class="input-field">
					      <span class="helper-text">I should to pay ($)</span>
					    </div>
		    		</div>
    			</fieldset>
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
@endsection
<script>

	let price_crypto = {{$precio}};

</script>
<script type="module" src="{{asset('js/buy_crypto/main.js')}}"></script>

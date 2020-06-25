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
					<div class="row">
						<div class="col s10 offset-s1">
							<center>
								<h5>{{$cryp_to_buy}}/{{$cryp_to_pay}}</h5>
							</center>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col s11 offset-s1 l5 offset-l1">
							<center>
								<form action="{{route('make_trade')}}" method="post">
									@csrf
									<div hidden>
										<input name="buy" value="{{$buy}}">
										<input name="pay" value="{{$pay}}">
										<input type="submit" id="buy-now">
									</div>
									<div class="input-field">
										<input id="user-amount" type="text" name="amount">
										<span class="helper-text">Amount</span>
									</div>
								</form>
								<a class="btn green modal-trigger" href="#confirm">Buy</a>
								<a class="btn red darken-1" href="{{route('setTrade',$pay.'-'.$buy)}}">Sell {{$buy}}</a>
							</center>
								
						</div>
						<div class="col s10 offset-s1 l5 offset-l1">
							<center>
								<table>
									<tr>	
										<th>Balance</th>
										<td>{{$cartera->cantidad}} {{$pay}}</td>
									</tr>
									<tr>
										<th>Amount</th>
										<td><span id="input-amount">Please, enter an amount</span> {{$buy}}</td>
									</tr>
									<tr>
										<th>Price</th>
										<td><span id="price-calculated">Not amount entered yet</span> {{$pay}}</td>
									</tr>
								</table>
							</center>
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col s12">
								<center>
									{{$cryp_to_buy}}: <span class="real_time_price">loading</span> $
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- Modal Structure -->
  <div id="confirm" class="modal">
    <div class="modal-content">
    	<center>
	      	<h4>Confirm your trade</h4>
	      	<label class="btn green" for="buy-now">Confirm</label>
      		<a href="#!" class="modal-close red btn">Cancel</a>
    	</center>
    </div>

  </div>
<input id="hidden-price-value" value="0" hidden>
@endsection
<script type="module" src="{{asset('js/trade/main.js')}}"></script>
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

	import {D} from "{{asset('js/trade/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/trade/Methods.js')}}";
	D.dom.load(function(){
		
		let cryp_to_buy = JSON.parse(Me.htmlDecode('{{$json_cryp_to_buy}}'));
		let cryp_to_pay = JSON.parse(Me.htmlDecode('{{$json_cryp_to_pay}}'));

		let comissions = [];
		comissions['general'] = {{$general_comission}};
		comissions['cambio'] = {{$change_comission}};

		Me.launchWsConsult(cryp_to_buy,cryp_to_pay,comissions);

		D.addEvent.onKeyUp('#user-amount',function(e){

			Me.changeAmount(e,comissions);
			
		});
		
	});

   		
</script>
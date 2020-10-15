@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
    <style>

    </style>
@endsection
@section('main')

	<div class="container-fluid">
		<div class="row">
			<div class="col s6">
				@yield('card')

			</div>
			<div class="col s6">
				<div class="card-panel">
					<h5 class="center">My criptos</h5>
					<hr>
					<ul class="collection">
				    	@forelse($carteras as $cartera)
							<li class="collection-item">
								{{$cartera->haiCriptomoneda->moneda->nombre}}
								@if($cartera->haiCriptomoneda->moneda->siglas != $criptomoneda->moneda->siglas)
									<a href="{{route('dashboard_clients')}}"><span class="badge new green" data-badge-caption="Buy more"></span></a>
								@endif
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
    	<button class="btn red modal-close">Cancel</button>
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
@yield('js')

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
						<h5>{{$current_crypto->moneda->siglas}}</h5>
					</center>
					<hr>

					<div class="row">
						<div class="col s10 offset-s1">
							
							<ul class="collection">
								@foreach($cryptos_arr['coinbase']['cryptos'] as $crypto_arr)
									<li class="collection-item">
										<b>{{$crypto_arr}}/{{$current_crypto->moneda->siglas}}:</b>
										<span data-crypto="{{$current_crypto->moneda->siglas}}" id="{{$crypto_arr}}-{{$current_crypto->moneda->siglas}}">Loading price</span>
										<i class="material-icons" style="color:lightgreen">file_upload</i>
										<a href="{{route('setTrade',$crypto_arr.'-'.$current_crypto->moneda->siglas)}}">
											<span data-badge-caption="buy" class="new badge blue"></span>
										</a>
										<!--span data-badge-caption="sell" class="new badge green"></span-->
									</li>
								@endforeach
								@foreach($cryptos_arr['coinlore']['cryptos'] as $crypto_arr)
									<!--li class="collection-item">
										<b>{{$crypto_arr}}/{{$current_crypto->moneda->siglas}}</b>
										<span id="{{$crypto_arr}}-{{$current_crypto->moneda->siglas}}">Loading price</span>
										<i class="material-icons" style="color:salmon">file_download</i>
										<span data-badge-caption="buy" class="new badge blue"></span>
										<span data-badge-caption="sell" class="new badge green"></span>
									</li-->
								@endforeach
								
							</ul>	
						</div>
					</div>
					<div class="card-action">

					</div>
				</div>
			</div>
		</div>
	</div>
               
@endsection
<script type="module" src="{{asset('js/trade/main.js')}}"></script>
@section('js')
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
	  });
	</script>
@endsection
<script type="module">
		import {D} from "{{asset('js/trade/Domm/Domm.js')}}";
		import {Me} from "{{asset('js/trade/Methods.js')}}";
		
		let current_crypto 	= [];
		current_crypto['id_origen'] = "{{$current_crypto->id_origen}}";
		current_crypto['url'] = "{{$current_crypto->origen->url}}";
		current_crypto['siglas'] = "{{$current_crypto->moneda->siglas}}";

		let obj_cryptos 	= JSON.parse(Me.htmlDecode('{{$cryptos_json}}'));

		let comission_trade = {{$comision_trade}};

		let comision_general = {{$comision_general}};

		let price_spans 	= Me.setPriceSpans(obj_cryptos,current_crypto['siglas']);		
		
		let price_cryptos 	= JSON.parse(Me.htmlDecode('{{$all_cryptos}}'));
		


		D.ws({

   			url:obj_cryptos.coinbase.url,

   			onOpen:function(){
   				Me.loadPrices(this,obj_cryptos.coinbase.cryptos);
   			},

   			onError:function(e){
   				console.log(e);
   			},

   			onMessage:function(e){
   				let data = JSON.parse(e.data);
   				if(data.type == 'ticker'){

   					Me.setPrice(data,price_cryptos,current_crypto['siglas'],price_spans,comission_trade,comision_general);
   					
   				}

   			},
   		});

		if(current_crypto['id_origen'] == 1){

	   		D.ws({

	   			url:current_crypto['url'],

	   			onOpen:function(){
	   				Me.loadPrices(this,[current_crypto['siglas']]);

	   			},

	   			onError:function(e){
   					console.log(e);
	   				
	   			},

	   			onMessage:function(e){   				
   					
   					let data = JSON.parse(e.data);
   					if(data.type == 'ticker'){
	   					Me.setPrices(data,price_cryptos,current_crypto['siglas'],price_spans,comission_trade,comision_general);
   						//Me.displayPrices(price_cryptos);

   						
	   				}

	   			},
	   		});

		}

   		
</script>
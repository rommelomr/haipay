@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')
    <div class="container-fluid" style="padding: 2%">
        <div class="row">
            <div class="col s7">
            	<div class="card-panel">
            		<div class="row">
            			<div class="col s12">
            				<h5 class="center">HaiPay Comissions</h5>
            			</div>
            		</div>
            		<div class="row valign-wrapper">
            			<div class="col s1">
            				%
            			</div>
            			<div class="col s5 center">
            				<label for="general">General comission</label>
            				<input class="update-comission" id="General" type="text" name="General" value="{{$comisiones['general']['porcentaje']}}">
            				<span id="helper-general" class="herlper-text red-text"></span>
            			</div>
            			<div class="col s6 center">
            				Comission that set the all cryptos' new price
            			</div>
            		</div>
            		<div class="row valign-wrapper">
            			<div class="col s1">
            				%
            			</div>
            			<div class="col s5 center">
            				<label for="buy_1">Buy {{$comisiones['buy 1']['minimo']}}$ to {{$comisiones['buy 1']['maximo']}}$</label>
            				<input class="update-comission" id="Buy 1" type="text" name="Buy 1" value="{{$comisiones['buy 1']['porcentaje']}}">
            				<span id="helper-buy-1" class="herlper-text red-text"></span>
            			</div>
            			<div class="col s6 center">
            				Comission for buy cryptos between {{$comisiones['buy 1']['minimo']}}$ to {{$comisiones['buy 1']['maximo']}}$
            			</div>
            		</div>
            		<div class="row valign-wrapper">
            			<div class="col s1">
            				%
            			</div>
            			<div class="col s5 center">
            				<label for="buy_2">Buy {{$comisiones['buy 2']['minimo']}} to {{$comisiones['buy 2']['maximo']}}</label>
            				<input class="update-comission" id="Buy 2" type="text" name="Buy 2" value="{{$comisiones['buy 2']['porcentaje']}}">
            				<span id="helper-buy-2" class="herlper-text red-text"></span>
            			</div>
            			<div class="col s6 center">
            				Comission for buy cryptos between {{$comisiones['buy 2']['minimo']}}$ to {{$comisiones['buy 2']['maximo']}}$
            			</div>
            		</div>
            		<div class="row valign-wrapper">
            			<div class="col s1">
            				%
            			</div>
            			<div class="col s5 center">
            				<label for="buy_3">Buy {{$comisiones['buy 3']['minimo']}} to {{$comisiones['buy 3']['maximo']}}</label>
            				<input class="update-comission" id="Buy 3" type="text" name="Buy 3" value="{{$comisiones['buy 3']['porcentaje']}}">
            				<span id="helper-buy-3" class="herlper-text red-text"></span>
            			</div>
            			<div class="col s6 center">
            				Comission for buy cryptos between {{$comisiones['buy 3']['minimo']}}$ to {{$comisiones['buy 3']['maximo']}}$
            			</div>
            		</div>
            		<div class="row valign-wrapper">
            			<div class="col s1">
            				%
            			</div>
            			<div class="col s5 center">

            				<label for="trade">Trade</label>
            				<input class="update-comission" id="Trade" type="text" name="Trade" value="{{$comisiones['trade']['porcentaje']}}">
            				<span id="helper-trade" class="herlper-text red-text"></span>

            			</div>
            			<div class="col s6 center">
            				Comission for trading
            			</div>
            		</div>
            	</div>
                
            </div>
            <div class="col s5">
                <div class="card-panel" style="overflow: scroll; height: 90vh">
                    <div class="row">
                        <div class="col s12">
                            <h5 class="center">Network Comissions</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <ul class="collection" >
                                    
                                @foreach($hai_criptomonedas as $hai_criptomoneda)
                                    <li class="collection-item">
                                        {{$hai_criptomoneda->moneda->nombre}}
                                        <span class="badge"><a href="#update-network-comission-modal" data-index="{{$hai_criptomoneda->moneda->siglas}}" data-value="{{$hai_criptomoneda->comision_red}}" class="modal-trigger crypto-item">{{$hai_criptomoneda->comision_red}} {{$hai_criptomoneda->moneda->siglas}}</a></span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
<form action="{{route('update_comission')}}" method="post" hidden>
    @csrf
    <input id="name_comission_input" name="name_comission">

    <input id="value_comission_input" name="value_comission">

    <input id="submit-button" type="submit">
    
</form>
<div id="modal-confirm" class="modal">
	<div id="modal-content" class="modal-content margin-0">
		<center>
			<h5>Are you sure you want to update this comission?</h4>
		</center>
	</div>
	<div class="modal-footer">
		<label for="submit-button" class="btn green">Yes</label>
		<button id="cancel-button" class="btn red darken-2 modal-close">No</button>
	</div>
</div>
<div id="update-network-comission-modal" class="modal">
    <div id="modal-content" class="modal-content margin-0">
        <center>
            <h5>Introduce new network comission</h4>
        </center>
        <div class="row">
            <form action="{{route('update_network_comission')}}" method="post">
                @csrf
                <div class="input-field col s12">
                    <input id="new_comission_value" name="new_comission_value">
                    <span class="helper-text"><span class="crypto-content"></span> network comission</span>
                </div>
                <div hidden>
                    
                    <input class="crypto-content" name="new_comission_acr">
                    <input type="submit">
                </div>

            </form>
        </div>
    </div>
    <div class="modal-footer">
        <label for="submit-button" class="btn green">Yes</label>
        <button id="cancel-button" class="btn red darken-2 modal-close">No</button>
    </div>
</div>

<script type="module">

	import {D} from '{{asset("js/Domm/Domm.js")}}';

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
<script type="module" src="{{asset('js/comissions/main.js')}}"></script>
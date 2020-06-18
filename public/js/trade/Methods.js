import {D} from './Domm/Domm.js';
export let Me = {
	/*
		Método que ejecutará las consultas ws a las dos criptomonedas
		Recibe dos parametros, ambos un arreglo con esta estructura
		[
			'siglas' -> siglas de la criptomoneda,
			'origen' -> 'url a la que se consultará el precio'
		]		
	*/

	launchWsConsult:function(cryp_to_buy,cryp_to_pay,comission){
		let prices = [];
		cryp_to_buy['i'] = 0;
		cryp_to_pay['i'] = 1;
		Me.consultPrice(cryp_to_buy,prices,comission);
		Me.consultPrice(cryp_to_pay,prices,comission);

	},

	/*

		Método que consulta el precio en tiempo real de una criptomoneda, y lo guarda en el
		arreglo prices[]

		Recibe un arreglo con la siguiente estructura
		[
			'siglas' -> siglas de la criptomoneda,
			'origen' -> 'url a la que se consultará el precio'
		]
	*/
	consultPrice:function(crypto,prices,comission){


		switch(crypto['origen']){
			case 'wss://ws-feed.pro.coinbase.com':{
				Me.consultCoinBasePrices(crypto,prices,comission);
				break;
			}
		}

	},

	/*
		Método que consulta el precio en tiempo real de una criptomoneda 
		cuya url sea wss://ws-feed.pro.coinbase.com
		Recibe:

		Un arreglo:
		[
			'siglas' -> siglas de la criptomoneda,
			'origen' -> 'url a la que se consultará el precio'
		]

	*/
	consultCoinBasePrices:function(crypto,prices,comission){
		D.ws({

			url:crypto['origen'],

			onOpen:function(){
				Me.loadPrices(this,[crypto['siglas']]);
			},

			onError:function(e){

				console.log(e);
			},

			onMessage:function(e){

				let data = JSON.parse(e.data);

				if(data.type == 'ticker'){

					let siglas = data.product_id.substr(0,3);

					prices[crypto['i']] = data.price;

					let user_amount = document.getElementById('user-amount');
					
					if(prices.length == 2){
						if(user_amount.value != ""){

							Me.setTradeWsMessage(user_amount.value, data,prices,comission);

						}
						let hidden_price_value = document.getElementById('hidden-price-value');

						hidden_price_value.value = Me.calculatePair(prices[0],prices[1]);

					}
					
				}
			},
		});

	},
	changeAmount:function(e,comissions){
		
		let input_amount = document.getElementById('input-amount');

		if(e.value != ""){
			
			input_amount.innerText = e.value;

			let hidden_price_value = document.getElementById('hidden-price-value');

			let elem_price_calculated = document.getElementById('price-calculated');
			if(hidden_price_value.value != 0){

				let price = hidden_price_value.value * e.value;

				let price_with_general_comission = price + Me.getComissions(price,comissions['general']);
				let total_price = price_with_general_comission + Me.getComissions(price,comissions['cambio']);
				
				elem_price_calculated.innerText = total_price;
			}else{

				elem_price_calculated.innerText = 'loading';
			}


		}else{
			input_amount.innerText = "Please, enter an amount";
			let elem_price_calculated = document.getElementById('price-calculated');
			elem_price_calculated.innerText = "Not amount entered yet";

		}
	},
	/*
	Metodo que configurará las criptomonedas obtenidas para la ruta
		/setTrade/crypto-crypto
	*/
	setTradeWsMessage:function(amount,data,prices,comission){
		
		let price = Me.calculatePair(prices[0],prices[1]);

		let price_with_general_comission = price + Me.getComissions(price,comission['general']);
		let total_price = price_with_general_comission + Me.getComissions(price,comission['cambio']);

		let elem_price_calculated = document.getElementById('price-calculated');
		let price_calculated = amount * total_price;
		elem_price_calculated.innerText = price_calculated;

	},
	setTradeWsMessageBuy:function(data,prices,comission){
		//console.log(prices[0])
		//prices[0] = data.price;
		//console.log(prices[0])
		let price = Me.calculatePair(prices[0],prices[1]);

	},
	
	loadPrices:function(wsObject,cryptos){

		let local_cryptos = [];

		for(let i = 0; i < cryptos.length; i++){
			local_cryptos.push(cryptos[i]+'-USD');
		}

		let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":local_cryptos}]});
		wsObject.send(json_to_send);		

	},
	setPrice:function(data,price_cryptos,current_crypto,price_spans,comission,comision_general){

		let id_trade = data.product_id.substr(0,3)+'-'+current_crypto;

		price_cryptos[id_trade] = data.price;

		if(price_cryptos[current_crypto+'-'+current_crypto] != 0){

			let price = Me.calculatePair(data.price,price_cryptos[current_crypto+'-'+current_crypto]);
			let comision_one = price + Me.getComissions(price,comission);
			let test = comision_one + Me.getComissions(price,comision_general);
			price_spans[id_trade].innerText = test;

		}
		
		
	},
	calculatePair:function(buy,pay){
		return (buy / pay);
	},
	getComissions:function(price,comission){

		price = parseFloat(price);
		comission = parseFloat(comission);

		return price * (comission/100);

	},
	
	setPrices:function(data,price_cryptos,current_crypto,price_spans,comission_trade,comision_general){

		let id_trade = data.product_id.substr(0,3)+'-'+current_crypto;

		price_cryptos[id_trade] = data.price;

		for(let i in price_spans){

			let price = Me.calculatePair(price_cryptos[i],price_cryptos[id_trade]);
			let comission_one = price + Me.getComissions(price,comission_trade);
			price_spans[i].innerText = comission_one + Me.getComissions(price,comision_general);

		}		
		
	},
	
	displayPrices:function(){

		let id_trade = data.product_id.substr(0,3)+'-'+current_crypto;
	},
	setPriceSpans:function(obj_cryptos,current_crypto){

		let price_spans = [];

		for(let i in obj_cryptos){

			for(let j = 0; j < obj_cryptos[i].cryptos.length; j++){
				let span_id = obj_cryptos[i].cryptos[j]+'-'+current_crypto;
				price_spans[span_id]=(document.getElementById(span_id));
			}			
		}
		return price_spans;

	},
	htmlDecode:function(input) {
	  var doc = new DOMParser().parseFromString(input, "text/html");
	  return doc.documentElement.textContent;
	}

}
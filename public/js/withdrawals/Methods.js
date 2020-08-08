import {D} from '../Domm/Domm.js';
export let Me = {

	updateComission:function(amount_to_retire,comissions){

		let comission_input = document.getElementById('comission');
		comission_input.value = D.math.decimals(parseFloat(comissions['network']) + (amount_to_retire.value*(comissions['retiro']/100)),2);

		

	},
	updateUSDAmount:function(amount_to_retire,general_comission){

		let real_time_crypto_price = document.getElementById('real-time-crypto-price');

		let usd_amount_input = document.getElementById('amount_in_usd');	

		let usd_amount = amount_to_retire.value * real_time_crypto_price.value;

		console.log(usd_amount);
		
		usd_amount_input.value = usd_amount - (usd_amount * (general_comission/100));


	},
	launchWebSocket:function(crypto){

		console.log(crypto);
		let price_element = document.getElementById('amount-to-retire');
		let amount_message = document.getElementById('amount-message');
		D.ws({

			url: crypto.origen,
			onOpen: function(){
				let pairs = [crypto.siglas+'-USD'];
				let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":pairs}]});
				this.send(json_to_send);
			},
			onMessage: function(r){

				let data = JSON.parse(r.data);

				if(data.type == 'ticker'){
					if(price_element.hasAttribute('disabled')){
						price_element.removeAttribute('disabled');
						amount_message.innerText = "Amount to retire";
					}
						D.dom.setValue('#real-time-crypto-price',data.price);
				}



			},
			onError: function(){

			},

		});
	}

}
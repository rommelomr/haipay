import {D} from '../Domm/Domm.js';
export let Me = {

	updateUSDAmount:function(amount_to_retire,comissions,usd_amount_input,real_time_crypto_price){

		let usd_amount = amount_to_retire.value * real_time_crypto_price.value;

		usd_amount_input.value = (usd_amount - comissions['network']) - (usd_amount * (comissions['retiro']/100));


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
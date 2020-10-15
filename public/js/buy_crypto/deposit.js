import {D} from "../Domm/Domm.js";
export let Me = {
	calculateComission:function(comision_deposito){
		let amount_input = document.getElementById('amount');
		let total_input = document.getElementById('total');

		let amount = parseFloat(amount_input.value);
		let comission = amount * (comision_deposito/100);

		let comission_input = document.getElementById('comission');
		
		comission_input.value = D.math.decimals(comission,2);
		total.value = D.math.decimals((amount + comission),2);
	},
	launchWsConsult:function(current_crypto,comision_deposito,comision_general){

		let real_time_price = document.getElementById('real-time-price');
		let amount = document.getElementById('amount');
		let total = document.getElementById('total');
		let amount_add_comission = 0;
		let price = 0;

		D.ws({
			url:current_crypto['url'],
			onOpen:function(e){
				let pair = [current_crypto['siglas']+'-USD'];
				let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":pair}]});
				this.send(json_to_send);
			},
			onError:function(e){
				console.log(e);
			},
			onMessage:function(e){

				let data = JSON.parse(e.data);

				if(data.type == 'ticker'){
					real_time_price.value = data.price;
					
					if(amount.value != ""){
						/*
						price = parseFloat(data.price);
						amount_add_comission = price + (price*(comision_deposito/100)) + (price*(comision_general/100));
						total.value = D.math.decimals(amount_add_comission,2);
						*/

					}


					
				}


			},
		});
	}
}
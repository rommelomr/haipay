import {D} from '../Domm/Domm.js';
export let Me = {
	redondeo2decimales:function(numero){
		var original=parseFloat(numero);
		var result=Math.round(original*10000)/10000 ;
		return result;
	},
	getComissions:function(price,comission){

		price = parseFloat(price);
		comission = parseFloat(comission);

		return price * (comission/100);

	},
	consultCoinbaseCryptos:function(data_api,comision_general){
		D.ws({
			url:data_api.url,
			onOpen:function(){

				let pairs = [];

				for(let i = 0; i < data_api.cryptos.length; i++){
					pairs.push(data_api.cryptos[i]+'-USD');
				}

				let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":pairs}]});
				this.send(json_to_send);

			},
			onError:function(e){
				console.log(e);
			},
			onMessage:function(e){

				let data = JSON.parse(e.data);
				if(data.type == 'ticker'){

					let spaces = document.querySelectorAll('.precio-'+data.product_id);

					for(let i = 0; i < spaces.length; i++){

						let precio = parseFloat(data.price);
						
						let precio_add_general = precio + Me.getComissions(precio,comision_general['porcentaje']);

						let precio_total = Me.redondeo2decimales(precio_add_general);
						
						spaces[i].innerText = precio_total;

					}
				}
			},
		});
	},
	consultPrice:function(data_api,comision_general){

		if(data_api.url == "wss://ws-feed.pro.coinbase.com"){
			Me.consultCoinbaseCryptos(data_api,comision_general);
		}
	},
	launchWsConsult:function(info_criptos,comision_general){

		Me.consultPrice(info_criptos.coinbase,comision_general);
		
	},
	htmlDecode:function(input) {
	  var doc = new DOMParser().parseFromString(input, "text/html");
	  return doc.documentElement.textContent;
	}	
}
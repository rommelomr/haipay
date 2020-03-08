import {F} from './global_functions.js';
export let Ev = {

    //Llenará en el modal todos los campos en los que se deba mostrar la criptomoneda elegida
	setNameModal:function(nombre,id){
		F.putContent('.space-name-cripto',nombre);
		F.putContent('.inputs-id-cripto',id);
		
	},
    setNameEvent:function(e){
		Ev.setNameModal(e.target.dataset.nombre_cripto,e.target.dataset.id_cripto);
	},		
	//Llenará en el modal todos los campos en los que se deba mostrar la criptomoneda elegida
}
export let Me = {
	//Actualizará los precios de las cripto en tiempo real
	updateCriptoValues:function(cripto_request, cripto_array){
			
		if(cripto_request.type == "ticker"){
			cripto_array[cripto_request.product_id] = cripto_request.price;
			F.putContent('.precio-'+cripto_request.product_id,cripto_request.price);
		}
		//console.log(cripto_array);
	},
	//Configurará la visualización del mensaje del modal, y el botón para enviar la solicitud
	changePayWithModal:function(){
    	let modal_message = document.getElementById('modal-message');
    	let submit_buy = document.getElementById('submit-buy');
    	let space_pay_with = document.getElementById('space-pay-with');
    	let pay_with = document.getElementById('payWith');

		let cuant_buy = document.getElementById('cuant_buy').value;
		let to_pay = document.getElementById('to_pay').value;

		if(pay_with.value!='none' && cuant_buy != '' && to_pay != ''){
				modal_message.removeAttribute('hidden');
				submit_buy.removeAttribute('disabled');
				space_pay_with.innerText = pay_with.value;
		}else{
				modal_message.setAttribute('hidden',true);
				submit_buy.setAttribute('disabled',true);
				space_pay_with.innerText = '';
		}
	},

	setModalMessage:function(amount,pay_with,cuant_buy){

		let e_to_pay = document.getElementById('modal-have-to-pay');
		e_to_pay.innerText = amount.value;
		let e_pay_with = document.getElementById('space-pay-with');
		e_pay_with.innerText = pay_with;
		let el_receive = document.getElementById('modal-recieve');
		el_receive.innerText = cuant_buy;

	},

	//Reseteará la configuracion del modal cada vez que se cierre
	resetModal:function(){
		let pay_with = document.getElementById('payWith');
		let to_pay = document.getElementById('to_pay');
		let cuant_buy = document.getElementById('cuant_buy');
		Me.disabledBuyButton(true);
		pay_with.value="none";
		to_pay.value = '';
		cuant_buy.value = '';
		Me.changePayWithModal();
	},

	coinbaseOnMessage:function (event,cripto) {
		Me.updateCriptoValues(JSON.parse(event.data),cripto);
	
	},
	
	coinbaseOnError:function (event) {
		console.log(event);
	},

	consultDogecoin:function (cripto_array) {

		fetch('https://api.coinlore.com/api/ticker/?id=2').then(function(response){
		    return response.json();
		    
		}).then(function(myJson){
			let object = {};
		    object.type = 'ticker';
		    object.product_id = 'DOGE-USD';
		    object.price = myJson[0].price_usd;
		    Me.updateCriptoValues(object,cripto_array);
		}).catch(function(error){
			console.log(error);
		});
	},
	calculateByBuy:function (criptos,cript_to_buy,comision) {
		let cuant_buy = document.getElementById('cuant_buy');
		let pay_with = document.getElementById('payWith');
		if(cuant_buy.value == ''){
			M.toast({html:'You must enter an amount to buy'});
			return false;
		}
		if(pay_with.value == 'none'){
			M.toast({html:'You must select what to pay with'});
			return false;
		}else{
			let to_pay = document.getElementById('to_pay');
			if(pay_with.value == 'USD'){
				var amount_to_pay = cript_to_buy['usd']*cuant_buy.value;
				amount_to_pay = amount_to_pay + (amount_to_pay * comision);
				to_pay.value = amount_to_pay;
			}else if(cuant_buy.value!=''){
				//Formula: Monto a pagar en $ = (cantidad de cripto a comprar) POR (precio en $ de la cripto a comprar) POR (valor de 1 $ expresado en la moneda con que voy a pagar)
				// Monto a pagar en $ / precio en $ de la cripto con que se paga = Precio total en la criptomoneda con que voy a pagar
				var amount_to_pay = (cuant_buy.value) * (cript_to_buy['usd']) * (1 / criptos[pay_with.value+'-USD']);
				amount_to_pay = amount_to_pay + (amount_to_pay * comision);
				to_pay.value = amount_to_pay;
			}
			this.disableModalMessage(to_pay.value,pay_with.value,cuant_buy.value);
			return true;
		}

	},
	calculateByPayment:function (criptos,cript_to_buy,comision) {
		let to_pay = document.getElementById('to_pay');
		let pay_with = document.getElementById('payWith');
		if(to_pay.value == ''){
			M.toast({html:'You must enter an amount to pay'});
			return false;
		}
		if(pay_with.value == 'none'){
			M.toast({html:'You must select what to pay with'});
			return false;
		}else if(to_pay.value!=''){
			let cuant_buy = document.getElementById('cuant_buy');
			let amount_to_pay = {
				value:parseFloat(to_pay.value)
			};
			//to_pay.value = parseInt(to_pay.value);
			amount_to_pay.value = (amount_to_pay.value - (amount_to_pay.value * comision));
			if(pay_with.value=='USD'){

				cuant_buy.value = amount_to_pay.value / cript_to_buy['usd'];
			}else{
				cuant_buy.value = amount_to_pay.value / (cript_to_buy['usd'] * 1 / criptos[pay_with.value+'-USD']);
			}
			this.disableModalMessage(amount_to_pay.value,pay_with.value,cuant_buy.value);
			return true;
		}

	},
	disableModalMessage:function (amount,pay_with,cuant_buy) {

		let submit_button = document.getElementById('submit-buy');
		submit_button.setAttribute('disabled',true);
		let modal_message = document.getElementById('modal-message');
		modal_message.setAttribute('hidden',true);
		this.setModalMessage(to_pay,pay_with,cuant_buy);

	},
	setHtgPrice:function (criptos) {

		let prueba = fetch('https://api.coinbase.com/v2/prices/BTC-HTG/buy').then(function(response,e){
		    return response.json();
		}).then(function(myJson){
			criptos['HTG-USD'] = criptos['BTC-USD']/myJson.data.amount;
		}).catch(function(error){
			console.log(error);
		});		
		
	},
	disabledBuyButton:function(state){
		let buy_button = document.getElementById('buy');
		if(state){
			buy_button.setAttribute('disabled',true);
		}else{
			buy_button.removeAttribute('disabled');
		}
	},
}

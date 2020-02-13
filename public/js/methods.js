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

		if(pay_with.value!='none'){
			modal_message.removeAttribute('hidden');
			submit_buy.removeAttribute('disabled');
			space_pay_with.innerText = pay_with.value;
		}else{
			modal_message.setAttribute('hidden',true);
			submit_buy.setAttribute('disabled',true);
			space_pay_with.innerText = '';
		}
	},

	//Reseteará la configuracion del modal cada vez que se cierre
	resetModal:function(){
		let pay_with = document.getElementById('payWith');
		let to_pay = document.getElementById('to_pay');
		let cuant_buy = document.getElementById('cuant_buy');
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
		    cripto_array = Me.updateCriptoValues(object,cripto_array);
		});
	},

	resetCost:function(criptos){
		let cuant_buy = document.getElementById('cuant_buy').value;
		let to_pay = document.getElementById('to_pay').value;
		console.log(criptos);


	},
	/*
	*/
}

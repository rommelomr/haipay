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
	updateCriptoValues:function(cripto){
		if(cripto.type == "ticker"){
			F.putContent('.precio-'+cripto.product_id,cripto.price);
		}
	},
	//Configurará la visualización del mensaje del modal, y el botón para enviar la solicitud
	changePayWithModal:function(){
    	let space_pay_with = document.getElementById('space-pay-with');
    	let modal_message = document.getElementById('modal-message');
    	let submit_buy = document.getElementById('submit-buy');
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
		pay_with.onchange = Me.changePayWithModal;
	},

	//Reseteará la configuracion del modal cada vez que se cierre
	resetModal:function(){
		let pay_with = document.getElementById('payWith');
		pay_with.value="none";
		Me.changePayWithModal();
	},

	coinbaseOnMessage:function (event) {
		Me.updateCriptoValues(JSON.parse(event.data));
	},
	
	coinbaseOnError:function (event) {
		console.log(event);
	},
	coinbaseOnError:function (event) {
		console.log(event);
	},
	consultDogecoin:function (event) {
		
		fetch('https://api.coinlore.com/api/ticker/?id=2').then(function(response){
		    return response.json();
		}).then(function(myJson){

		    
		    let object = {};
		    object.type = 'ticker';
		    object.product_id = 'DOGE-USD';
		    object.price = myJson[0].price_usd;
		    Me.updateCriptoValues(object);
		});
	},

	resetCost:function(e){
		let cant_buy = getElementById('cant_buy').value;
		let to_pay = getElementById('to_pay').value;
		console.log(e.target);
		//F.addEvent.onClick('.re_calculate',this.);

	},
	calculeBuyCost:function(){
		
		F.addEvent.onKeyUp('.re_calculate',this.resetCost);
		F.addEvent.onChange('.re_calculate_change',this.resetCost);

	},
}

import {D} from './Domm/Domm.js';
export let Me = {
	asignarTransaccion:function(e){

		let input_transaction = document.getElementById('id_transaction');
		input_transaction.value=e.target.dataset.id_transaction;
	},
	configurarModalEnviarImagen:function(e){
		Me.asignarTransaccion(e);
		let form = document.getElementById('verificaction_form');
		form.setAttribute('action','/verify_pyment');
	},
	configurarModalReenviarImagen:function(e){
		Me.asignarTransaccion(e);
		let form = document.getElementById('verificaction_form');
		form.setAttribute('action','/resend_image');
	},
	
}
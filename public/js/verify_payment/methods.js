import {D} from './Domm/Domm.js';
export let Me = {
	asignarTransaccion:function(e){
		let input_transaction = document.getElementById('id_transaction');
		input_transaction.value=e.target.dataset.id_transaction;
	},
	configurarModalEnviarImagen:function(e){
		Me.asignarTransaccion(e);
		document.getElementById('modal-title').innerText = 'Send Verification Image';
		let form = document.getElementById('verificaction_form');
		form.setAttribute('action','/verify_transaction');
	},
	configurarModalReenviarImagen:function(e){
		Me.asignarTransaccion(e);
		document.getElementById('modal-title').innerText = 'Resend Verification Image';
		let form = document.getElementById('verificaction_form');
		form.setAttribute('action','/resend_image');
	},
	configurarModalEliminarTransaccion:function(e){
		console.log(e.target);
		let input_transaction = document.getElementById('id_transaction_delete');
		input_transaction.value=e.target.dataset.id_transaction;
		document.getElementById('modal-title').innerText = 'Delete remittance';
		let form = document.getElementById('form_delete_transaction');
		form.setAttribute('action','/delete_transaction');
	},
	
}
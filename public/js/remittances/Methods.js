import {D} from '../Domm/Domm.js';
export let Me = {

	consultarPersonasPorCedula:function(id_not_found_message,send_button,input_receiver_name,cedula,url){

		D.getAjax({

			url:url,
			asyn:true,
			params:{
				cedula:cedula
			},
			success:function(data){
				console.log(data);
				

				if(data.data.status == 0){

					input_receiver_name.value = '';
					input_receiver_name.removeAttribute('readonly');
					

					if(id_not_found_message.hasAttribute('hidden')){
						id_not_found_message.classList.add('helper-text');
						id_not_found_message.removeAttribute('hidden');
					}

				}else{
					
					if(!id_not_found_message.hasAttribute('hidden')){
						id_not_found_message.classList.remove('helper-text');
						id_not_found_message.setAttribute('hidden',true);
					}
					input_receiver_name.value = data.data.name;
					let input_amount = document.getElementById('monto');
					send_button.removeAttribute('disabled');
					

				}
			},
			error:function(){
				alert('Have ocurred a problem');
			},

		});

	},
	setTransactionRemittance:function(el){

		let monto = document.getElementById('amount');
		monto.innerText = el.dataset.amount;

		let register_code = document.getElementById('receiver-register-code');
		register_code.innerText = el.dataset.receiver_register_code;
		
		let cedula = document.getElementById('receiver-id');
		cedula.innerText = el.dataset.receiver_id;

		let nombre = document.getElementById('receiver-name');
		nombre.innerText = el.dataset.receiver_name;

		let imagen = document.getElementById('imagen');
		imagen.src = el.dataset.image;

		

		let transaction = document.querySelectorAll('.transaction');

		for(let i = 0; i<transaction.length; i++){

			transaction[i].value = el.dataset.id_transaction;
		}

	}
}
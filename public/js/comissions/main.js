import {D} from '../Domm/Domm.js';
import {Me} from './Methods.js';

document.addEventListener('DOMContentLoaded', function() {

	let elem_modal = document.querySelectorAll('.modal');

	let instances_modal = M.Modal.init(elem_modal);
	
	let comission_inputs = Me.getComissionInputs();

	let update_form_inputs = Me.getUpdateFormInputs();

	let crypto_items = D.dom.getElementsByClass('crypto-item');

	D.addEvent.onKeyUp('.update-comission',function(el,ev){
		
		if(ev.which == 13){

			Me.setUpdateForm(el,comission_inputs,update_form_inputs);
			
			let cancel_button = document.getElementById('cancel-button');
			Me.confirmUpdate(ev,instances_modal,cancel_button);

		}
	});

	D.addEvent.onClick('.crypto-item',function(el,ev){
		
		Me.setUpdateNetForm(el,crypto_items);
	});

});
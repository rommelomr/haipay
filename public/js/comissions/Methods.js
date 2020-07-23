import {D} from '../Domm/Domm.js';
export let Me = {

	setUpdateFormInputs:function(update_form_inputs,name,value){
		
		update_form_inputs['name'].value = name;
		update_form_inputs['value'].value = value;

	},
	getUpdateFormInputs:function(){
		let name_comission_input = document.getElementById('name_comission_input');
		let value_comission_input = document.getElementById('value_comission_input');

		let arr = [];

		arr['name'] = name_comission_input;
		arr['value'] = value_comission_input;

		return  arr;
	},
	getComissionInputs:function(){
		let inputs = document.querySelectorAll('.update-comission');
		let arr = [];
		for (var i = 0; i < inputs.length; i++) {
			arr[inputs[i].id] = inputs[i];
		}
		return arr;

	},
	setUpdateNetForm:function(el,crypto_items){
		
		D.dom.putContent('.crypto-content',crypto_items[el.dataset.index].dataset.index);
		D.dom.setValue('#new_comission_value',crypto_items[el.dataset.index].dataset.value);
	},
	setUpdateForm:function(el,comission_inputs,update_form_inputs){

		Me.setUpdateFormInputs(update_form_inputs,el.id,comission_inputs[el.id].value);

	},
	confirmUpdate:function(ev,instances_modal,cancel_button){

		instances_modal[0].open();
		cancel_button.focus();
	
	}
	

}
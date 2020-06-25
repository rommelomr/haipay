import {D} from './Domm/Domm.js';
import {Me} from './Methods.js';

D.dom.load(function(){

	
	D.addEvent.onKeyUp('#amount',function(e){

		let save_price = document.getElementById('save-price');
		let to_pay_input = document.getElementById('to-pay');

		if(save_price.value != ""){

			to_pay_input.value = e.value * save_price.value;

		}else{

			to_pay_input.value = "loading";

		}

		Me.setBuyButton(e);


		Me.setAmountForm(e);

	});
	
	D.addEvent.onChange('#type_operation',function(e){
		
		Me.setBuyButton(e);

		Me.setTypeOperationForm(e);
	});

});
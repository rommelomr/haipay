export let Me = {
	calculateToPay:function(e,price){

		return e.value * price;

	},
	enableBuyButton:function(){

		let form_type_operation = document.getElementById('form-type-operation');
		let form_amount = document.getElementById('form-amount');
		console.log([
			'form_type_operation',
			form_type_operation,
			'form_amount',
			form_amount,
		]);
		if(form_type_operation.value != '' && form_amount.value != ''){

			let buy_button = document.getElementById('buy_button');
			buy_button.removeAttribute('disabled');
				
		}
	},
	disableBuyButton:function(){
		let buy_button = document.getElementById('buy_button');
		buy_button.setAttribute('disabled',true);

	},
	setToPayPlaces:function(amount){

		let to_pay = document.getElementById('to-pay');
		let to_pay_text = document.getElementById('to-pay-text');
		let form_to_pay = document.getElementById('form-to-pay');
		to_pay.value = amount;
		to_pay_text.innerText = amount;
		form_to_pay.value = amount;
		

	},
	setAmountPlaces:function(e){

		let i_will_recieve_text = document.getElementById('i-will-recieve-text');
		let form_amount = document.getElementById('form-amount');

		if(e.value == ''){

			i_will_recieve_text.innerText = 0;
			e.value = 0;
			form_amount.value = '';

		}else{
			i_will_recieve_text.innerText = e.value;
			form_amount.value = e.value;

		}
	},
	cleanTypeOperationPlaces:function(e){
		let form_type_operation = document.getElementById('form-type-operation');
		form_type_operation.value = '';
	},
	setTypeOperationPlaces:function(e){

		let form_type_operation = document.getElementById('form-type-operation');
		form_type_operation.value = e.value;
		

	},
	cleanAmountInputs:function(e){

		let dependent_amount = document.querySelectorAll('.dependent-amount');

		for(let i = 0; i < dependent_amount.length; i++){
			dependent_amount[i].value = '';
		}

	}
	
	
}
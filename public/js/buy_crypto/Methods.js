import {D} from "../Domm/Domm.js";
export let Me = {

	setAmountForm:function(e){
		console.log(e);
		let amount = document.getElementById('send_amount');
		amount.value = e.value;
	},
	setTypeOperationForm:function(e){
		console.log(e);
		let type_operation = document.getElementById('send_type_operation');
		type_operation.value = e.value;
	},
	guardarPrecioEnDom:function(precio){
		
		let input_precio = document.getElementById('save-price');
		input_precio.value = precio;

	},
	mostrarToPay:function(precio){
		let amount = document.getElementById('amount');
		let to_pay = document.getElementById('to-pay');
		if(amount.value == ''){
			if(to_pay.value != ''){
				to_pay.value = "";
			}
		}else{

			to_pay.value = Me.calculateToPay(amount,precio);
		}
	},
	mostrarPrecio:function(precio){
		let spaces = document.querySelectorAll('.real-time-price');
		for (var i = 0; i < spaces.length; i++){
			spaces[i].innerText = precio;
		}
	},
	calcularPrecio:function(data,comisiones){

		let precio_neto = parseFloat(data.price);
		let precio_add_general = precio_neto + Me.getComissions(precio_neto,comisiones['general']);
		let precio_add_compra = precio_add_general + Me.getComissions(precio_neto,comisiones['compra']);
		let precio_total = Me.redondearDecimales(precio_add_compra,4);

		return precio_total;
	},
	redondearDecimales:function(num,dec){

		let original = parseFloat(num);
		let decimales = Math.pow(10,dec)
		let result=Math.round(original*decimales)/decimales;

		return result;
	},
	getComissions:function(price,comission){

		price = parseFloat(price);
		comission = parseFloat(comission);

		return price * (comission/100);

	},
	launchWsConsult:function(current_crypto,comisiones){
		D.ws({
			url:current_crypto['url'],
			onOpen:function(e){
				let pair = [current_crypto.siglas+'-USD'];
				let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":pair}]});
				this.send(json_to_send);
			},
			onError:function(e){
				console.log(e);
			},
			onMessage:function(e){

				let data = JSON.parse(e.data);
				if(data.type == 'ticker'){

					let precio = Me.calcularPrecio(data,comisiones);

					Me.mostrarPrecio(precio);
					Me.mostrarToPay(precio);
					Me.guardarPrecioEnDom(precio);
					
				}


			},
		});

	},
	calculateToPay:function(e,price){

		return e.value * price;

	},
	getOtherInput:function(e){
		if(e.id == 'amount'){

			return document.getElementById('type_operation');

		}else if(e.id == 'type_operation'){

			return document.getElementById('amount');

		}
	},
	setBuyButton:function(e){
		
		let other = Me.getOtherInput(e);

		console.log(other.value);

		let addToCarButton = document.getElementById('buy_button');

		if(other.value != '' && e.value != ''){

			if(addToCarButton.hasAttribute('disabled')){

				addToCarButton.removeAttribute('disabled');
			}

		}else{
			
				addToCarButton.setAttribute('disabled',true);

		}

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
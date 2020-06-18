import {D} from './Domm/Domm.js';
import {Me} from './Methods.js';

D.dom.load(function(){

	D.addEvent.onClick('#button_calculate',function(){

		let input = document.getElementById('amount');
		let to_pay = Me.calculateToPay(input,price_crypto);
		Me.setToPayPlaces(to_pay);
		Me.setAmountPlaces(input);
		let type_operation = document.getElementById('type_operation');
		Me.setTypeOperationPlaces(type_operation);
		Me.enableBuyButton();
	});
	
	D.addEvent.onKeyUp('#amount',function(e){
		Me.cleanAmountInputs();
		Me.disableBuyButton();
	});
	
	D.addEvent.onChange('#type_operation',function(e){

		Me.disableBuyButton();

	});
});
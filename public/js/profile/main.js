import {D} from '../Domm/Domm.js';

D.dom.load(function(){
	let father = document.getElementById('father');
	let form = document.getElementById('form');
	let string_type = document.querySelectorAll('.string-type');
	

	D.addEvent.onClick('.adress-link',function(el){
		
		father.value = el.dataset.crypto_id;
		form.action = el.dataset.route;

		for (var i = 0; i < string_type.length; i++) {
			string_type[i].innerText = el.dataset.string_type;
		}
	});
	D.addEvent.onClick('.tag-link',function(el){

		father.value = el.dataset.cartera_id;
		form.action = el.dataset.route;

		for (var i = 0; i < string_type.length; i++) {
			string_type[i].innerText = el.dataset.string_type;
		}
	});

});
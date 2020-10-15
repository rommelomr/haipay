import {D} from "../Domm/Domm.js";

D.dom.load(function(){

	D.addEvent.onClick('.deliver',function(el,ev){

		let remittance_id_input = document.getElementById('remittance_id');
		
		remittance_id_input.value = el.dataset.remittance_id;

	});

});

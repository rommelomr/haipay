import {D} from './Domm/Domm.js';
import {Me} from './methods.js';
D.dom.load(function(){

	D.addEvent.onClick('.send_image',Me.configurarModalEnviarImagen);
	D.addEvent.onClick('.resend_image',Me.configurarModalReenviarImagen);
	D.addEvent.onClick('.delete_transaction',Me.configurarModalEliminarTransaccion);

	

});
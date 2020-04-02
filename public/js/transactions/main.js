import {D} from './Domm/Domm.js';
import {Me} from './methods.js';

D.dom.load(function(){
	D.addEvent.onClick('.transaction-item',Me.setTransactionClick);
});
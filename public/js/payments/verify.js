import {D} from './Domm/Domm.js';
import {Me} from './Methods.js';

D.dom.load(function(){

	D.addEvent.onClick('.collection-item',Me.setTransaction);
});
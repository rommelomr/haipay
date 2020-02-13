export let F = {
	//Return an element dataset array 
	inspect:function(arr){
		for (var i = arr.length - 1; i >= 0; i--) {
			console.log(arr[i]);
		}
	},
	//Return an element dataset array 
	getDataset:function(el){
		return document.getElementById(el).dataset;
	},
	//Set the several inputs value founded by a querySelectorAll
	setValue:function(elems,data){
		let dom_elems = document.querySelectorAll(elems);
		for(let i=0; i<dom_elems.length;i++){
			dom_elems[i].value = data;
		}
	},
	//Set the several element text founded by a querySelectorAll
	setText:function(elems,data){
		let dom_elems = document.querySelectorAll(elems);
		for(let i=0; i<dom_elems.length;i++){
			dom_elems[i].innerText = data;
		}
	},
	//Set the value and/or texto of an input and/or element founded by a querySelectorAll
	putContent:function(elems,data){
		this.setValue(elems,data);
		this.setText(elems,data);
	},
	addEvent:{
		//set the onclick event in several elements by a querySelectorAll
		onClick:function(el,f){
			let dom_elems = document.querySelectorAll(el);
			for(let i=0; i<dom_elems.length;i++){
				dom_elems[i].onclick = f;
			}
		},
		onChange:function(el,f){
			let dom_elems = document.querySelectorAll(el);
			for(let i=0; i<dom_elems.length;i++){
				dom_elems[i].onchange = f;
			}
		},
		onKeyUp:function(el,f){
			let dom_elems = document.querySelectorAll(el);
			for(let i=0; i<dom_elems.length;i++){
				dom_elems[i].onkeyup = f;
			}
		},
		
		
	},
	ws(object){
		/*
			Websocket Request
			Receive an object with this attributes:
			url: irl's api
			onOpen: method executed when the ws is open
			onMessage: method executed when the ws return a response
			onError: method executed if an error occurs
		*/
		let ws_conection = new WebSocket(object.url);
		ws_conection.onopen = object.onOpen;
		ws_conection.onmessage = object.onMessage;
		ws_conection.onerror = object.onError;
	}	
	
}
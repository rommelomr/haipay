import {Ajax} from './Ajax.js';
export let D = {
	//Return an element dataset array 
	inspect:function(arr){
		if(!Array.isArray(arr)){
			arr = [arr];
		}
		for (var key in arr) {
			console.log(arr[key]);
		}
	},
	dom:{
		load:function(f){
			window.addEventListener('load',f);
		},
		//empty inputs by a selector
		unvalue:function(selector){
			let el = document.querySelectorAll(selector);
			
			for(let i = 0; i < el.length; i++){
				el[i].value="";
			}
		},
		//empty elements by a selector
		emptyNodes:function(selector){
			let el = document.querySelectorAll(selector);
			for(let i = 0; i<el.length; i++){
				this.emptyNode(el[i]);
			}
		},
		//empty elements by a selector
		emptyNode:function(node){
    		while(node.hasChildNodes()){
				node.removeChild(node.firstChild);
			}
    	},
		
		//empty inputs and elements by a selector
		fullEmpty:function(selector){
			this.emptyNodes(selector);
			this.unvalue(selector);
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
		//Create a new element with content an element especified by an id
		createElement(id,insert){
			let element = document.getElementById(id);
			let text = document.createTextNode(insert);
			element.appendChild(text);
		},
		/*
		Create many elements recursively into another element specified by an id
		use example:
		{
			id:'example' //id's father element
			insert:{
				tag:'h5', //tag of the new element that will be created
				id:'example_2', new element's id
				attrs:{class:'examples_2',}, new element's class
				insert:{ //Content we're going to insert. Could be a string (either the simple content, or another element following the same structure)
					tag:'h4',
					id:'example_3',
					attrs:{class:'examples_3',},
					insert:[
						{tag:'h3',id:'example_4',attrs:{class:'examples_4',},insert:'child'},
						{tag:'h3',id:'example_5',attrs:{class:'examples_5',},insert:'child'},
					]

				}
			}
		}
		*/
		createElements:function(object){
			if(typeof(object.insert) == 'string'){
		
				this.createElement(object.id,object.insert);

			}else{

				if(!Array.isArray(object.insert)){
					object.insert = [object.insert];
				}
				for(let i in object.insert){

					let parent = document.getElementById(object.id);
					let new_element = document.createElement(object.insert[i].tag);
					new_element.setAttribute('id',object.insert[i].id);

					
					if(object.insert[i].attrs != undefined){
						for(let key in object.insert[i].attrs){
							new_element.setAttribute(key,object.insert[i].attrs[key])
						}
					}
					if(object.insert[i].data != undefined){
						for(let key in object.insert[i].data){
							new_element.setAttribute('data-'+key,object.insert[i].data[key])
						}
					}
					
					parent.appendChild(new_element);

					this.createElements({
						id:object.insert[i].id,
						insert:object.insert[i].insert
					});
				}
				/*
				for(let i in object.insert){
					new_element.setAttribute('id',object[i].insert.id);
					alert(object[i].insert.tag);

				}
				*/
			}
		},
	},
	addEvent:{
		//set the onclick event in several elements by a querySelectorAll
		onClick:function(el,f){
			let dom_elems = document.querySelectorAll(el);
			for(let i=0; i<dom_elems.length;i++){
				dom_elems[i].onclick = function(){
					f(this);
				};
			}
		},
		onChange:function(el,f){
			let dom_elems = document.querySelectorAll(el);
			for(let i=0; i<dom_elems.length;i++){
				dom_elems[i].onchange = function(){
					f(this);
				};
			}
		},
		onKeyUp:function(el,f){
			let dom_elems = document.querySelectorAll(el);
			for(let i=0; i<dom_elems.length;i++){
				dom_elems[i].onkeyup = function(){
					f(this);
				};
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
	},
	getAjax(object){
		/*
			Método que hace una peticion AJAX por GET
			Recibe un objeto con
			object.url (obligatorio): string que contiene la URL a la que se le hará la peticion
			object.asyn: booleano que indica si la peticion será asincrona (true) o no (false)
			object.params objeto que contiene los parámetros que se enviarán por get
			object.success funcion que se ejecutará si la llamada ajax se ejecuta correctamente
			object.error funcion que se ejecutará si hay un error en la llamada ajax
		*/
		let ajax = new Ajax(object);
		ajax.exec();
		return ajax.getResponse();
	},
	setInputNotMatch:function(id){
		document.querySelector(id).value = '';
	},
	setInputMatch:function(object){
		alert('You must enter the function will be called when the user selected a result');
	},
	/*Initialize the ajax searcher. Receive an object with:

		url:,
		id_input:input's id which users'll enter the search (required),
		id_value:input's id which the software will put the result (required),
		error:Function called if there is an error in the ajax conection,
		success:Function called if the ajax conection is successful (required),
		data_identifier: the odentifier which the searcher will find the selected option,
		setInputMatch:function called when the user select an option recommended
		},
	*/
	initSearcher:function(object){

		if(object.setInputMatch == undefined){
			object.setInputMatch = this.setInputMatch;
		}
		if(object.setInputNotMatch == undefined){
			object.setInputNotMatch = this.setInputNotMatch;
		}
		
		F.addEvent.onKeyUp(object.id_input,(e)=>{
			if(e instanceof KeyboardEvent){
				let set_ajax = {
					url:object.url,
					params:{
						string:e.target.value
					},
					success:object.success,
					error:object.error,
				}
				F.getAjax(set_ajax);
			}
			let set_searcher_value = document.querySelector('[data-'+object.data_identifier+'="'+e.target.value+'"]');//[name=""]
			if(set_searcher_value!=undefined){
				object.setInputMatch(set_searcher_value);
			}else{
				object.setInputNotMatch(object.id_value);
			}
		})

	}
	
}
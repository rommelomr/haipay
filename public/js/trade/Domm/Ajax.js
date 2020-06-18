export class Ajax{
	constructor(object){

		this.setRequest(new XMLHttpRequest());
		if(object.method!=undefined){
			this.setMethod(object.method);
		}else{
			this.setMethod('GET');
		}
		if(object.params!=undefined){
			this.setParams(object.params);
		}else{
			this.setParams({});
		}
		if(object.url!=undefined){
			if(this.getMethod() == 'GET' && this.getParams() != ''){
				this.setUrl(object.url+'?'+this.getParams());
			}else{
				this.setUrl(object.url);
			}
		}else{
			alert('You must enter a valid URL');
		}
		if(object.type!=undefined){
			this.setType(object.type);
		}else{
			this.setType(true);
		}
		this.setResponse(null);

		if(object.success != undefined){
			this.setSuccessFunction(object.success);
		}else{
			this.setSuccessFunction(this.defaultSuccess);
		}

		if(object.error != undefined){
			this.setErrorFunction(object.error);
		}else{
			this.setErrorFunction(this.defaultError);
		}
		
	};
	setSuccessFunction(f){
		 this.successFunction = f;
	}
	setErrorFunction(f){
		 this.errorFunction = f;
	}
	successFunction(data){
		this.successFunction(data);
	}
	errorFunction(data){
		this.errorFunction(data);
	}
	
	defaultSuccess(){
		alert('You must enter a function, which will be called after a success AJAX Request');
	}
	defaultError(){
		alert('You must enter a function, which will be called after an error with the AJAX Request');
	}
	
	setRequest(request){

		this._request = request;
	}
	setResponse(response){

		this._response = response;
	}
	setMethod(method){

		this._method = method;
	}
	setUrl(url,params){
		this._url = url;
	}
	setParams(params){
		let string = '';
		let length = Object.keys(params).length;
		let i = 1;

		for(let key in params){
			params[key] = encodeURI(params[key]);

			params[key] = this.cleanChars(params[key],{
				'&':'%26',
				'/':'%2F',
				'\\?':'%3F',
			});
			string = string+key+'='+params[key];

			if(i < length){
				string = string + '&';
			}
			i++;
		}
		this._params = string;
	}
	setType(type){

		this._type = type;
	}
	getRequest(){

		return this._request;
	}
	getResponse(){

		return this._response;
	}
	getMethod(){

		return this._method;
	}
	getUrl(){

		return this._url;
	}
	getParams(){

		return this._params;
	}
	getType(){

		return this._type;
	}
	cleanChars(string,arr){
		for(let key in arr){
			string = this.cleanChar(string,key,arr[key]);
		}
		return string;
	}
	cleanChar(string,char,code){

		while(string.search(char)!=-1){
			let pos = string.search(char);
			if(pos == 0){
				let string_aux = string.substring(1,string.length);
				string = code+string_aux;
			}else if(pos == string.length-1){
				let string_aux = string.substring(0,string.length-1);
				string = string_aux+code;
			}else{
				let string_aux_left = string.substring(0,pos);
				let string_aux_right = string.substring(pos+1,string.length);
				string = string_aux_left+code+string_aux_right;
			}
		}
		return string;
	}
	getReadyState(){
		switch(this.getRequest().readyState){
			case 0:{
				return {
					ready_state:0,
					message:'Request not initialized'
				}
			}
			case 1:{
				return {
					ready_state:1,
					message:'Server connection established'
				}
			}
			case 2:{
				return {
					ready_state:2,
					message:'Request received'
				}
			}
			case 3:{
				return {
					state:3,
					message:'Processing request'
				}
			}
			case 4:{
				return {
					ready_state:4,
					message:'Request finished and response is ready'
				}
			}
			
		}
	};
//
	getData(){

		if(this.getRequest().readyState == 4 && this.getRequest().status == 200){
			return JSON.parse(this.getRequest().responseText);
		}else{
			return {message:'There is no data received'};
		}
	};
	getStatus(){
		return {
			status:this.getRequest().status,
			message:this.getRequest().statusText
		}
	}
	sendRequest(){
		if(this.getMethod() == 'POST' && this.getParams() != ''){
			this.getRequest().send(this.getParams());
		}else{
			this.getRequest().send(this.getParams());
		}
	}
	exec(){

		let request = this.getRequest();
		request.open(this.getMethod(),this.getUrl(),this.getType());
		this.sendRequest();
		request.onreadystatechange = ()=>{

			this.setResponse(new Object);

			let response = this.getResponse();

			response.request = this.getReadyState();

			if(response.request.ready_state == 4){

				response.response = this.getStatus();

				if(response.response.status == 200){

					response.data = this.getData();
					this.successFunction(response);

				}
			}
		}

	}
}
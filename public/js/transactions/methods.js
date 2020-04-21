export let Me = {
	setTransactionClick:function(e){
		console.log(e.target.dataset.url);
		let url = e.target.dataset.url;
		location.href = "/"+url;
	},
	sendChangeStateForm:function(e){
		let form = document.getElementById('form-change-state');
		let input_estado = document.getElementById('csf-id-estado');
		console.log(e.target);
		input_estado.value = e.target.dataset.state;
		form.submit();

	}
}
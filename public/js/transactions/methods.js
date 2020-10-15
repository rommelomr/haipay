export let Me = {
	setTransactionClick:function(e){
		console.log(e.target.dataset.url);
		let url = e.target.dataset.url;
		location.href = "/"+url;
	},
	sendChangeStateForm:function(e){
		let form = document.getElementById('form-change-state');
		let input_estado = document.getElementById('csf-id-estado');

		input_estado.value = e.target.dataset.state;

		let observacion_modal = document.getElementById('observacion_modal');
		let observacion = document.getElementById('observacion');

		observacion.value = observacion_modal.value;

		form.submit();

	}
}
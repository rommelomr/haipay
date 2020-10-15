export let Me = {
	setTable: function(data){
		let url = document.getElementById('url');
		url.innerText = data.url;
		url.href = data.url;

		let crypto = document.getElementById('crypto');
		crypto.innerText = data.crypto;

		let client = document.getElementById('client');
		client.innerText = data.client;

		let image = document.getElementById('image');
		image.src = data.image;

		let deposit_id = document.getElementById('deposit_id');
		deposit_id.value = data.deposit_id;

		let crypto_id = document.getElementById('crypto_id');
		crypto_id.value = data.crypto_id;
		
		
		
	},
	sendForm: function(data){

		let status = document.getElementById('status');
		status.value = data.status;
		
		if(data.status == 2){
			
			let amount = document.getElementById('amount');
			amount.value = 0;
		}

		let form = document.getElementById('form');
		form.submit();
	}
}
export let Me = {

	setTransaction:function(e){
		
		let transaction = document.querySelectorAll('.transaction');
		let span_transaction = document.getElementById('span_transaction');
		let monto = document.getElementById('monto');
		let buy = document.querySelectorAll('.buy');
		let pay = document.querySelectorAll('.pay');
		let price = document.getElementById('precio');
		let total = document.getElementById('total');
		let imagen = document.getElementById('imagen');
		console.log(e.dataset.tiene_imagen);
		if(e.dataset.tiene_imagen == "1"){

			imagen.setAttribute('src',e.dataset.image);
		}

		span_transaction.innerText = e.dataset.transaction;

		for(let i = 0; i<transaction.length; i++){

			transaction[i].value = e.dataset.transaction;
		}

		price.innerText = e.dataset.price;

		monto.innerText = e.dataset.monto;

		for (let i = buy.length - 1; i >= 0; i--) {
			buy[i].innerText = e.dataset.buy;
		}
		for (let i = pay.length - 1; i >= 0; i--) {
			pay[i].innerText = e.dataset.pay;
		}
		
		total.innerText = e.dataset.total;

	}
}
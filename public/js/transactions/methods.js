export let Me = {
	setTransactionClick:function(e){
		console.log(e);
		let url = e.target.dataset.url;
		location.href = "/"+url;
	}
}
export let Materialize = {
	init:function(arr){

		let materialize_arr = {};
		for(let i = 0; i<arr.length;i++){

			switch(arr[i]){
				case 'modal':{

					let modal_elems = document.querySelectorAll('.modal');
					materialize_arr.modal = M.Modal.init(modal_elems);

					break;
				}

			}
		}

		return materialize_arr;

	}
}
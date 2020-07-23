window.addEventListener('load',function(){
	let tooltip_elems = document.querySelectorAll('.tooltipped');
	let tooltip_instances = M.Tooltip.init(tooltip_elems);

	let modal_elems = document.querySelectorAll('.modal');
	let modal_instantces = M.Modal.init(modal_elems);
});
@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
    <style>

    </style>
@endsection
@section('main')

	<div class="row">
		<div class="col s8 offset-s2">
			<div class="card-panel">
				<div class="row">
					<div class="col s12">
						<center>
							<h5>{{$client->usuario->persona->nombre}}</h5>
						</center>
					</div>
				</div>
				<hr>
				<div class="row">
					@foreach($client->imagenesVerificacion as $imagen)
					<div class="col s12 l6">
						<div class="card">
							<div class="card-image">
								<img src="{{Storage::url($imagen->nombre)}}" class="responsive-img materialboxed">
							</div>
							@if($imagen->estado == 0)
								<div class="card-action image" data-id="{{$imagen->id}}">
									<center>

										<a href="#verify-modal" class="btn green approve modal-trigger">Approve</a>
										<a href="#verify-modal" class="btn red refuse modal-trigger">Refuse</a>
											
									</center>
								</div>
							@else
								<div class="card-action">
									@if($imagen->estado == 1)
										Image approved
									@else
										Image refused
									@endif
								</div>
							@endif
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
<div id="verify-modal" class="modal">
	<div class="modal-content">
		Do you really want to <b><span id="message"></span></b> this image?
	</div>
	<div class="modal-footer">
		<label for="submit" class="btn modal-close green">Yes</label>
		<button class="btn modal-close red">Cancel</button>
	</div>
</div>
<form action="{{route('verify_image_moderator')}}" method="post" hidden>
	@csrf
	<input id="image" type="text" name="image_id">
	<input id="status" type="text" name="status">
	<input type="submit" id="submit">
</form>          
@endsection
  <!-- Modal Structure -->
<script type="module">

	import {D} from "{{asset('js/Domm/Domm.js')}}";
	D.dom.load(function(){

	    let mtb_elems = document.querySelectorAll('.materialboxed');
    	let instances = M.Materialbox.init(mtb_elems);

    	let modal_elems = document.querySelectorAll('.modal');
    	let modal_instances = M.Modal.init(modal_elems);

		D.addEvent.onClick('.image',function(el){

			let image_input = document.getElementById('image');
			image_input.value = el.dataset.id;
		});
		D.addEvent.onClick('.approve',function(el){

			let status_input = document.getElementById('status');
			let message_span = document.getElementById('message');
			message.innerText = "approve";
			status_input.value = 1;
		});
		D.addEvent.onClick('.refuse',function(el){

			let status_input = document.getElementById('status');
			let message_span = document.getElementById('message');
			message.innerText = "refuse";
			status_input.value = 2;
		});
		
		
	});
</script>
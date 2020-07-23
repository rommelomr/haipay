@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/dash_clients.css')}}">
@endsection
@section('main')
    <div class="container">
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<div class="row">
						<div class="col s12 center">
							<h5>Complete the receiver's profile</h5>
							<p>You have sent a remittance to a person who is not in our records.</p>
							<p>May you tell us his/her full name?</p>
						</div>
					</div>
				    <div class="row">
						<form action="{{route('register_no_user')}}" method="post">
							@csrf
					        <div class="col s6 input-field">
					        	<label for="id">Receiver's ID</label>
					        	<input id="id" type="text" disabled value="{{$cedula}}">
					        </div>
					        <div class="col s6 input-field">

					        	<input id="full_name" type="text" name="full_name">

					        	<span class="helper-text red-text">
					        		If you write the receiver's name with an error, you can't modify it by yourself. You must contact to support and notificate the change.
					        	</span>
					        </div>
					        <div hidden>
						        <input type="submit" id="submit-button">
						        <input name="id_persona" value="{{$id}}">
					        </div>
						</form>
				    </div>
				    <div class="row">
				    	<div class="col s12">
				    		<center>
					    		<a href="#modal-confirm" class="modal-trigger btn green">Save</a>
				    		</center>
				    	</div>
				    </div>
				</div>
			</div>
		</div>
    </div>
<div class="modal" id="modal-confirm">
	<div class="modal-content">
		<h5>Are you sure you want to register now?</h5>
	</div>
	<div class="modal-footer">
		<label for="submit-button" class="btn modal-close green">Save</label>
		<button class="btn modal-close red darken-3">Cancel</button>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		@if(session('messages'))
			@foreach(session('messages') as $messages)
			  M.toast({html: '{{$messages}}'})
			@endforeach

		@endif
		
		@if ($errors->any())
            @foreach ($errors->all() as $error)
	  			M.toast({html: '{{ $error }}'})
            @endforeach
		@endif

		let el_modal = document.querySelectorAll('.modal');
		let instances = M.Modal.init(el_modal);
	});
</script>
@endsection
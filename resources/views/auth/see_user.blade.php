@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
@endsection
@section('main')

	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<div class="row">
						<div class="col s12">
							<h5 class="center">User</h5>
						</div>
					</div>
					<hr>
					<form action="{{route('edit_user')}}" method="post" id="edit-form">
						@csrf
						<input value="{{$user->id}}" name="id_user" hidden>
						<div class="row">
							<div class="col s6">Name</div>
							<div class="col s6"><input type="text" style="width:100%" class="browser-default" value="{{$user->persona->nombre}}" name="nombre"></div>
						</div>
						<div class="row">
							<div class="col s6">ID</div>
							<div class="col s6"><input type="text" style="width:100%" value="{{$user->persona->cedula}}" name="cedula" class="browser-default"></div>
						</div>
						<div class="row">
							<div class="col s6">email</div>
							<div class="col s6"><input type="text" style="width:100%" value="{{$user->email}}" name="email" class="browser-default"></div>
						</div>
						<div class="row">
							<div class="col s6">phone</div>
							<div class="col s6"><input type="text" style="width:100%" value="{{$user->telefono}}" name="telefono" class="browser-default"></div>
						</div>
						<div class="row">
							<div class="col s6">Status</div>
							<div class="col s6">

								<select name="esta_activo" class="browser-default">
									<option @if($user->estado == 1) selected @endif value="1">Enabled</option>
									<option @if($user->estado == 0) selected @endif value="0">Disabled</option>
								</select>

							</div>
						</div>
						<div class="row">
							<div class="col s6">Verified</div>
							<div class="col s6">

								<select name="esta_verificado" class="browser-default">
									<option value="1" @if($user->verificado == 1) selected @endif>Yes</option>
									<option value="0" @if($user->verificado == 0) selected @endif>No</option>
								</select>

							</div>
						</div>
						<input id="submit" type="submit" hidden>
					</form>
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
<div id="modal-confirm" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5 class="center">Do you <b>really</b> want to save changes?</h5>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<label for="submit" class="btn modal-close green">Confirm</label>
		<button class="btn modal-close red">Cancel</button>
	</div>
</div>
@endsection

<script>
	window.onload = function(){
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
		
		var elems_modal = document.querySelectorAll('.modal');
    	var instances = M.Modal.init(elems_modal);

		let form = document.querySelector('#edit-form');

		form.onkeypress = function(e){
			if(e.which == 13){
				return false;
			}
		}

	}
</script>

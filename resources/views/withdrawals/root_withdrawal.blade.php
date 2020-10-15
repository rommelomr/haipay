@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')

<div class="container">
	<div class="card-panel">
		<div class="row">
			<div class="col s12">
				<center>
					<h5>Configure minimum amount to withdrawal</h5>
				</center>
			</div>
		</div>
		<div class="row">
			<form action="{{route('change_minimum_to_withdraw')}}" method="post">
				@csrf
				<div class="col s12 input-field">
					<input type="text" name="minimum" value="{{$minimum}}">
				</div>
				<div class="col s12 input-field">
					<a href="#confirm" class="modal-trigger btn green">Change</a>
				</div>
				<input id="submit" type="submit" hidden>
			</form>
		</div>
	</div>
</div>

<div id="confirm" class="modal">
	<div class="modal-content">
		<center>
			<h5>Are you sure you want to change the minimum now?</h5>
		</center>
	</div>
	<div class="modal-footer">

		<label for="submit" class="btn red">Yes</label>
		<button class="btn red modal-close">No</button>

	</div>

</div>
@endsection
<script src="{{asset('js/withdrawals_mod/materialize.js')}}"></script>
<script type="module">

	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/withdrawals/Methods.js')}}";

	window.addEventListener('load',function(){

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

		let modal_elems = document.querySelectorAll('.modal');
		let modal_instances = M.Modal.init(modal_elems);
				
	});

</script>

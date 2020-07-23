@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')

	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="card-panel center">
					<i class="material-icons large">tag_faces</i>
					<h5>Your pursache is almost ready</h5>
					<p>Now, you must <a href="{{route('verify_payments')}}">verify it</a> sending a picture showing the deposit or transaction</p>
				</div>
			</div>
		</div>
	</div>
@endsection
<script>
	
	document.addEventListener('DOMContentLoaded', function() {
		var elems_modal = document.querySelectorAll('.modal');
		var instances = M.Modal.init(elems_modal);

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

	  });

</script>
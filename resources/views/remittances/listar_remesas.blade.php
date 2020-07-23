@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
	<link rel="stylesheet" href="{{asset('css/remittances/main.css')}}">
@endsection
@section('main')
    <div class="container-fluid" style="margin:2%">
    	<div class="card-panel">
    		<h5>All remittances</h5>
	    	<div class="divider"></div>
	    	<div class="row">
	    		<div class="col offset-s8 s4">
	    			<form action="{{route('search_remittances')}}" method="post">
	    				<div class="input-field">
	    					<label for="search">Search Remittance</label>
	    					<input id="search" name="string" type="text">
	    				</div>
	    			</form>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col s10 offset-s1">
	    			<table class="centered">
	    				<thead>
		    				<tr>
								<th>Transmitter</th>
								<th>Receiver</th>
								<th>Amount to deliver</th>
		    				</tr>
	    				</thead>
	    				@forelse($remesas as $remesa)
	    					<tr class="clickable_row" data-url="{{route('see_remittance',$remesa->id)}}">
	    						
		    					<td>{{$remesa->emisor->usuario->persona->nombre}}</td>
		    					
		    					@if($remesa->id_tipo_remesa == 1)
		    						<td></td>
		    					@elseif($remesa->id_tipo_remesa == 2)
		    						@if($remesa->remesaExterna->noUsuario->persona->nombre == null)
		    							<td>Empty</td>
		    						@else
		    							<td>{{$remesa->remesaExterna->noUsuario->persona->nombre}}</td>
		    						@endif
		    					@endif
	    						
	    						<td>{{$remesa->monto_total}} HTG</td>
	    					</tr>
	    				
	    				@empty
	    					<tr>
	    						
	    						<td colspan="3">
		    						there's not remittances to deliver
	    						</td>
	    					</tr>
	    				@endforelse
	    			</table>
	    		</div>
	    	</div>
    	</div>
    </div>

<div id="modal-confirm" class="modal">
	<div id="modal-content" class="modal-content margin-0">
		<center>
			<h5>Are you sure you want to send now?</h4>
		</center>
	</div>
	<div class="modal-footer">
		<label for="input-submit" class="btn green">Yes</label>
		<button class="btn red darken-2 modal-close">No</button>
	</div>
</div>
@endsection

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
		let el_tabs = document.querySelector('.tabs');
		let instance_tabs = M.Tabs.init(el_tabs);

 		let elem_modal = document.querySelectorAll('.modal');
    	let instances_modal = M.Modal.init(elem_modal);

	});
</script>
<script type="module" src="{{asset('js/remittances/main.js')}}"></script>
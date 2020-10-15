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
								<th>Receiver</th>
								<th>I.D.</th>
								<th>Amount to deliver</th>
								<th>Retirement method</th>
								<th>Options</th>
		    				</tr>
	    				</thead>
	    				<tbody>
	    					
		    				@forelse($remesas as $remesa)
		    					<tr class="clickable_row" data-url="{{route('see_remittance',$remesa->id)}}" data-emisor="" data-receiver="" data-receivers-ID="" >
		    						
			    					
			    					@if($remesa->id_tipo_remesa == 1)
			    						<td>
			    							{{$remesa->remesaInterna->cliente->usuario->persona->nombre}}
			    						</td>
			    					@elseif($remesa->id_tipo_remesa == 2)
		    							<td>
		    								{{$remesa->remesaExterna->noUsuario->persona->nombre}}
		    							</td>
			    					@endif
		    						
			    					@if($remesa->id_tipo_remesa == 1)
			    						<td>
			    							{{$remesa->remesaInterna->cliente->usuario->persona->cedula}}
			    						</td>
			    					@elseif($remesa->id_tipo_remesa == 2)
		    							<td>
		    								{{$remesa->remesaExterna->noUsuario->persona->cedula}}
		    							</td>
			    					@endif
		    						
		    						<td>{{$remesa->monto_total}} HTG</td>

		    						<td>{{$remesa->metodoRetiro->nombre}}</td>

		    						<td><a href="#modal-confirm" data-remittance_id="{{$remesa->id}}" class="modal-trigger deliver btn green">delivered</a></td>
		    					</tr>
		    				
		    				@empty
	    				</tbody>
	    					<tr>
	    						
	    						<td colspan="5">
		    						there's not remittances to deliver
	    						</td>
	    					</tr>
	    				@endforelse
	    			</table>
	    		</div>
	    	</div>
    	</div>
    </div>
<div hidden>
	<form action="{{route('deliver_remittance')}}" method="post">
		@csrf
		<input id="remittance_id" name="remittance_id">
		<input type="submit" id="submit">
	</form>
</div>
<div id="modal-confirm" class="modal">

	<div id="modal-content" class="modal-content margin-0">

		<center>

			<h5>Are you sure you want to check as delivered?</h4>

		</center>

	</div>
	<div class="modal-footer">

		<label for="submit" class="btn green darken-2">Confirm</label>

		<button class="btn red darken-2 modal-close">Cancel</button>

	</div>
</div>
@endsection

<script type="module">

	import {D} from "{{asset('js/Domm/Domm.js')}}";

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
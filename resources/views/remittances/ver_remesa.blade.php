@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')
    <div class="container-fluid" style="margin:2%">
    	<div class="card-panel">
    		<div class="row">
        		<div class="col s4">
        			<div class="row">
        				<div class="col s12">
	    					<img src="{{asset('images/fondo_login.png')}}" alt="" class="materialboxed responsive-img">
        				</div>
        			</div>
        			<div class="row">
        				<div class="col s6">

        					<a href="#modal-confirm" class="btn btn-small z-depth-1 green lighten-1 center modal-trigger"><i class="material-icons">check_circle</i></a>

        				</div>
        				<div class="col s6">

							<a href="#modal-confirm" class="btn btn-small z-depth-1 red lighten-1 center modal-trigger"><i class="material-icons">cancel</i></a>

        				</div>
        			</div>
	    		</div>
	    		<div class="col s8">
	    			
		    		<h5>Remittance # {{$remesa->id}}</h5>
			    	<div class="divider"></div>
			    	<table>
						<tr>
							<th>Transmitter</th>
							<td>{{$remesa->emisor->usuario->persona->nombre}}</td>
						</tr>
						<tr>
							<th>Receiver</th>

							@if($remesa->id_tipo_remesa == 1)
								<td></td>
							@elseif($remesa->id_tipo_remesa == 2)
								@if($remesa->remesaExterna->noUsuario->persona->nombre == null)
									<td>Empty</td>
								@else
									<td>{{$remesa->remesaExterna->noUsuario->persona->nombre}}</td>
								@endif
							@endif
						</tr>
						<tr>
							<th>General comission</th>
							<td>{{$remesa->comision_general}} %</td>
						</tr>
						<tr>
							<th>Buy comission</th>
							<td>{{$remesa->comision_compra}} %</td>
						</tr>
						<tr>
							<th>Amount to deliver</th>
							<td>{{$remesa->monto_total}} HTG</td>
						</tr>
						
			    	</table>
	    		</div>
    		</div>
    	</div>
    </div>

<div id="modal-confirm" class="modal">
	<div id="modal-content" class="modal-content margin-0">
		<form action="{{route('change_state_remittance')}}" method="post">
			
		</form>
		<center>
			<h5>Are you sure you want to send now?</h4>
		</center>
	</div>
	<div class="modal-footer">
		<label for="input-submit" class="btn green">Yes</label>
		<button class="btn red darken-2 modal-close">No</button>
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

    	let elems_modal = document.querySelectorAll('.modal');
    	let instances_modal = M.Modal.init(elems_modal);
    	
	    let elems_images = document.querySelectorAll('.materialboxed');
	    let instances_iamges = M.Materialbox.init(elems_images);

	});
</script>
@endsection
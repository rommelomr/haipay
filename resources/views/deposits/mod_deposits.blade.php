@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
	
@endsection

@section('main')

	<div class="container">

		<div class="card-panel">
			<div class="row">
				<div class="col s12">
					<center>
						<h5>Deposits</h5>
					</center>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					 <ul class="collection">
					 	@forelse($deposits as $deposit)
						 	<li class="collection-item pointer"

						 		data-image="{{Storage::url($deposit->imagen)}}"

						 		data-url="{{$deposit->url}}"

						 		data-client="{{$deposit->cliente->usuario->persona->nombre}}"

						 		data-crypto="{{$deposit->haiCriptomoneda->moneda->siglas}}"

						 		data-deposit_id="{{$deposit->id}}"

						 		data-crypto_id="{{$deposit->haiCriptomoneda->id}}">

						 		<b>Deposit #:</b> {{$deposit->id}}
						 		<span class="badge"><b>Client:</b> {{$deposit->cliente->usuario->persona->nombre}}</span>
						 		
						 	</li>
					 	@empty
					 		<center>
					 			
					 			There are no deposits to show
					 		</center>	
					 	@endforelse
					 </ul>
					
				</div>
				<div class="col s10 offset-s1">
					<center>

						{{$deposits->links('commons.pagination',[
							'paginate'=>$deposits,
							'max_buttons'=>5
							])}}

					</center>
				
				</div>
			</div>
		</div>
		
	</div>
<div id="modal-info" class="modal modal-fixed-footer">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<center>
		 			<h5>Deposit info</h5>
	 			</center>
			</div>
		</div>
		<div class="row">
			<div class="col s12 l6">
				<img id="image" class="responsive-img">
			</div>
			<div class="col s12 l6">
				<div class="row">
					<div class="col s12">
						<table class="stripped centered">
							<tr>
								<th>URL</th>
								<td><a id="url" target="_blank"></a></td>
							</tr>
							<tr>
								<th>Crypto</th>
								<td id="crypto">Crypto</td>
							</tr>
							<tr>
								<th>Client</th>
								<td id="client">Client</td>
							</tr>
							
						</table>
					</div>
				</div>
				<div class="row">
					<form id="form" action="{{route('verify_deposit')}}" method="post">
						@csrf
					    <div class="col s12 input-field">
					    	<label for="amount">Amount to accredit</label>
					    	<input id="amount" type="text" name="amount">
					    </div>
					    <div hidden>
						    <input id="status" name="status">
						    <input id="deposit_id" name="deposit_id">
						    <input id="crypto_id" name="crypto_id">
					    	
					    </div>

					</form>
					    
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="status btn green" data-status="1">Acept</button>
		<button class="status btn red" data-status="2">Refuse</button>
		<button class="btn modal-close btn-flat">Close</button>
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
        
    });
</script>
<script type="module">
	import {Materialize} from "{{asset('js/materialize/materialize_init.js')}}";
	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/deposits/methods.js')}}";
	D.dom.load(function(){

		let m = Materialize.init(['modal']);
		D.addEvent.onClick('.pointer',function(el){
			Me.setTable(el.dataset);
			m.modal[0].open();
		})

		D.addEvent.onClick('.status',function(el){
			Me.sendForm(el.dataset);
		})

	});

	
</script>
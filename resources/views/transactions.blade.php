@extends('layouts.sidenav')
@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('css/transactions.css')}}">
@endsection
@section('main')
	<div class="row">
		<div class="col s12 l6">
			
			<div class="card">
				<nav class="nav-extended indigo">
					<div class="nav-content">
						<center>
							<span class="nav-title">Pending Transactions</span>
						</center>
					</div>
					
				</nav>
        <div class="row">
          <div class="col s10 offset-s1">
            <form action="#" method="get">
              <div class="input-field">
                <label for="search-transaction">Search Transaction</label>
                <input type="text" name="id_transaction">
                <i class="material-icons prefix">search</i>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
            <div id="transactions-container" class="col s10 offset-s1">
                <ul class="collection">
                  @forelse($transacciones as $transaccion)
                    <li class="collection-item transaction-item" data-url="transactions/{{$transaccion->id}}">

                      <b>{{$transaccion->tipoTransaccion->nombre}}:</b> {{$transaccion->cliente->usuario->persona->nombre}}
                      <i class="material-icons secondary-content">access_alarm</i>
                    </li>
                  @empty
                  There's no pending transactions
                  @endforelse
                </ul>
            </div>          
        </div>
        <!--RENOVACION-->
			</div>
		</div>
    @if($watch)
  		<div class="col s12 l6">
  			
  			<div class="card-panel">
          <center>
            <h5>Details</h5>          
          </center>
          <hr>
  				<div class="row">
  					<div class="col s4">
  						<center>
                @if($transaction->cliente->imagenesVerificacion == null)
  							 <img class="responsive-img materialboxed" src="{{asset('images/profile.png')}}" alt="">
                @else
                 <img class="responsive-img materialboxed" src="{{Storage::url($transaction->cliente->imagenesVerificacion[0]->nombre)}}" alt="">
                @endif
  						</center>
  					</div>
            <div class="col s8">
              <fieldset>
                <legend>
                  <b>User's info</b>
                </legend>
                <table class="centered">
                    <tr>
                      <th>Name</th>
                      <td>{{$transaccion->cliente->usuario->persona->nombre}}</td>
                    <tr>
                    </tr>
                      <th>ID</th>
                      <td>{{$transaccion->cliente->usuario->persona->cedula}}</td>
                    </tr>
                    </tr>
                      <th>State</th>
                      @if($transaccion->cliente->usuario->persona->usuario->estado == 1)
                        <td>Active</td>
                      @elseif($transaccion->cliente->usuario->persona->usuario->estado == 2)
                        <td>Unactive</td>
                      @elseif($transaccion->cliente->usuario->persona->usuario->estado == 3)
                        <td>{{$transaccion->cliente->usuario->estado}}</td>
                      @endif
                    </tr>                    
                </table>
              </fieldset>
            </div>
  				</div>
          <hr>
          <div class="row">
            <table>
              <tr>
                <td>Transaction Type</td>
                <td>{{$transaction->tipoTransaccion->nombre}}</td>
              </tr>

              <!--Si es una Remesa-->
              <tr>
                <td>Monto</td>
                <td>{{$transaction->tipoTransaccion->nombre}}</td>
              </tr>
              <!--Si es una Remesa interna-->
              @if($transaction->id_tipo_transaccion <= 2)
              <tr>
                <td>Transaction Type</td>
                <td>{{$transaction->tipoTransaccion->nombre}}</td>
              </tr>
              @elseif($transaction->id_tipo_transaccion > 2)
              @endif
              <!--Si es una Remesa externa-->
              <!--Si es una Compra-->
              
            </table>
          </div>
  			</div>
  		</div>
    @endif
	</div>
<!-- Modal Structure -->
<div id="modal-details" class="modal bottom-sheet">
	<div class="modal-content">
		<center>
	  		<h4>Transaction details</h4>
		</center>
	  	<div class="row">
	  		<div class="col s6">
	  			<center>
	  				
					<img class="materialboxed" src="{{asset('images/logo.png')}}" alt="">
					<img class="materialboxed" src="{{asset('images/logo.png')}}" alt="">
	  			</center>
	  		</div>
	  		<div class="col s6">
	  			<center>
		  			<b>Transaction:</b> Remittance<br>
		  			<b>Name:</b> Rommel Omar Montoya Rodriguez<br>
		  			<b>Amount:</b> 250$<br>
		  			<b>Payment Method:</b> Paypal<br>
		  			<button class="btn green lighten-1">Verify</button>
	  			</center>
	  		</div>
				<form action="">
					<div class="input-field col s8 offset-s2">
						<label for="message">Send a Message</label>
						<input id="message" type="text">
						<i class="material-icons prefix">send</i>
					</div>
			  		
				</form>
	  	</div>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<center>
			See <a href="#modal-deleted-transactions" class="modal-trigger">deleted transactions</a>
		</center>
	</div>
</div>

<div id="modal-delete" class="modal">
	<div class="modal-content">
		<center>
	  		<h4>Delete transaction</h4>
			Are you sure you want to delete this transaction? <br>
			This action can't be reversed
		</center>
	</div>
	<div class="modal-footer">
		<a href="#!" class="btn modal-close indigo">Agree</a>
		<a href="#!" class="btn modal-close red">Cancel</a>
	</div>
</div>

<div id="modal-deleted-transactions" class="modal modal-fixed-footer">
	<div class="modal-content">
		<center>
	  		<h4>Deleted transactions</h4>
		</center>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Remittance dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Remittance</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Payment dd/mm/aaaa</div>
      <div class="collapsible-body">
      	<table class="centered">
      		<thead>
      			<tr>
      				<th>Author</th>
      				<th>Transaction</th>
      				<th>date</th>
      				<th>Amount</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr>
      				<td>Rommel Omar Montoya Rodriguez</td>
      				<td>Payment</td>
      				<td>dd/mm/aaaa</td>
      				<td>200$</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </li>
    
  </ul>
        
	</div>
	<div class="modal-footer">
		<a href="#!" class="btn modal-close indigo">Agree</a>
		<a href="#!" class="btn modal-close red">Cancel</a>
	</div>
</div>

@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems_modal = document.querySelectorAll('.modal');
    var instances_modal = M.Modal.init(elems_modal);
    	
    var elems_images = document.querySelectorAll('.materialboxed');
    var instances_iamges = M.Materialbox.init(elems_images);

    var elems_collapsible = document.querySelectorAll('.collapsible');
    var instances_collapsible = M.Collapsible.init(elems_collapsible);
  });
</script>
<script type="module" src="{{asset('js/transactions/main.js')}}"></script>
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
							<span class="nav-title">Transactions</span>
						</center>
					</div>
					
				</nav>
				<div id="transactions-panel">
					<div class="row valign-wrapper">
						<div class="col s6">
							<div class="row">
								
								<form action="">
									<div class="input-field col s11">
										<label for="search-transaction">Search Transaction</label>
										<input type="text" name="id_transaction">
										<i class="material-icons prefix">search</i>
									</div>
								</form>
							</div>
							<center>								
								<div id="dont-selected" class="" hidden>
										Dont transaction selected
								</div>
								<div id="transaction">
									<div class="card-panel">
										<b>Name:</b> Rommel Omar Montoya Rodriguez <br><br>
										<b>Transaction:</b> Remittance <br><br>
										<a href="#modal-details" class="btn indigo modal-trigger">See details</a>
										<button href="#modal-delete" class="btn red modal-trigger">Delete</button>
									</div>
								</div>
							</center>
							
						</div>
						<div id="transactions-container" class="col s6">
						    <ul class="collection">
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Payment
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Payment
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      <li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Remittance
						      </li>
						      
						    </ul>
						</div>
					</div>
				</div>
					
				<div class="card-footer">
					<center>
						<h5>Pending Transaction</h5>
						<ul class="collection">
							<li class="collection-item">
								<i class="material-icons">access_alarm</i>
								Payment
							</li>
						</ul>
					</center>

				</div>
			</div>
		</div>
		<div class="col s12 l6">
			
			<div class="card">
				<nav class="nav-extended indigo">
					<div class="nav-content">
						<center>
							<span class="nav-title">User's Transaction</span>
						</center>
					</div>
				</nav>
				<div class="row">
					<div class="col s8 offset-s2">
						<form action="">
							
							<div class="input-field">
								<label for="user">Search User</label>
								<input id="user" type="text">
								<i class="material-icons prefix">search</i>
							</div>
						</form>
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col s4">
						<center>
							<b>Rommel Omar Montoya Rodriguez</b><br><br>
							<img class="responsive-img materialboxed" src="{{asset('images/profile.png')}}" alt="">
						</center>
					</div>
					<div id="user-transactions-container" class="col s7">
						<ul class="collection">
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							
							<li class="collection-item">
								<i class="material-icons">indeterminate_check_box</i>
								Remittance
							</li>
							<li class="collection-item">
								<i class="material-icons">check_box</i>
								Payment
							</li>
							
						</ul>
					</div>
				</div>
				
			</div>
		</div>

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
    	instances_modal[2].open();
    var elems_images = document.querySelectorAll('.materialboxed');
    var instances_iamges = M.Materialbox.init(elems_images);

    var elems_collapsible = document.querySelectorAll('.collapsible');
    var instances_collapsible = M.Collapsible.init(elems_collapsible);
  });
</script>
@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <!--link rel="stylesheet" href="{{asset('css/dash_clients.css')}}"-->
@endsection
@section('main')

    <div class="container">
        <div class="row">
            <div class="col s12">
        		<div class="card-panel">
            		<div class="row">
            			<div class="col s12">

            				<h5 class="center">Confirm Remittance</h5>
            			</div>
            		</div>
            		<div class="row">
            			<div class="col s12">
            				
            			</div>
            		</div>
            		<div class="row">
            			<div class="col s12">
            				
	                		<table >
								<tr>
									<th>Receiver's ID</th>
									<td>{{$receivers_id}}</td>
									
								</tr>
								<tr>
									<th>You must pay</th>
									<td>{{$amount_to_send}}$</td>
									
								</tr>
								<tr>
									<th>Total to retire</th>
									<td>{{$htg_to_deliver}} HTG</td>
									
								</tr>
								
								<tr>
									<th>Receivers full name</th>
									<td>{{$receivers_name}}</td>
									
								</tr>
								<tr>
									<th>Payment method</th>
									<td>{{$payment_method['nombre']}}</td>
									
								</tr>
								<tr>
									<th>Retirement method</th>
									<td>{{$retirement_method['nombre']}}</td>
									
								</tr>
	                			
	                		</table>
            			</div>
            		</div>
            		<div class="row">
            			<div class="col s12">
            				<center>
	            				<label class="btn green" for="submit-button">Send now</label>
            				</center>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
<form action="{{route('enviar_remesa')}}" method="post" hidden>
	@csrf
<input name="receivers_id" value="{{$receivers_id}}">
<input name="amount_to_send" value="{{$amount_to_send}}">
<input name="receivers_name" value="{{$receivers_name}}">
<input name="payment_method" value="{{$payment_method['id']}}">
<input name="retirement_method" value="{{$retirement_method['id']}}">
<input type="submit" id="submit-button">
</form>
@endsection
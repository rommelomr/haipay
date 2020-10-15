@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')
	<div class="container">
   		<div class="row">
   			<div class="col s12">
   				<div class="card-panel">
   					<div class="row">
   						<div class="col s12">
   							<center>
	   							<h5>My remittances</h5>
   							</center>
   						</div>
   					</div>
   					<div class="row">
   						<div class="col s10 offset-s1">
   							<ul class="collection">
   								@forelse($remittances as $remittance)
   									<li class="collection-item">
   										<p><b>Sender:</b> {{$remittance->emisor->usuario->persona->nombre}}</p>
   										<p><b>Amount:</b> {{$remittance->monto_total}} HTG</p>
   										<p><b>Withdrawal method:</b> {{$remittance->metodoRetiro->nombre}}</p>
									   </li>
   								@empty
                              <li class="collection-item">
                                 <center>
                                    There is no remittances to show
                                 </center>
                              </li>
   								@endforelse
   							</ul>
   						</div>
						<div class="col s10 offset-s1">
							<center>

								{{$remittances->links('commons.pagination',[
									'paginate'=>$remittances,
									])}}

							</center>
						
						</div>
   					</div>
   				</div>
   			</div>
   		</div>		
	</div>
@endsection
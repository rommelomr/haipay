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
  					<div class="col s4 offset-s1">
              <div class="card">
                <div class="card-image">
                  @if(count($transaction->cliente->imagenesVerificacion) <= 0)
    							 <img class="responsive-img" src="{{asset('images/profile.png')}}" alt="">
                  @else
                   <img class="responsive-img materialboxed" src="{{Storage::url($transaction->cliente->imagenesVerificacion[0]->nombre)}}" alt="">
                  @endif
                </div>
                <div class="card-content">
                  <center>
                    <p>User's Image</p>
                  </center>
                </div>
              </div> 
  					</div>
            <div class="col s4 offset-s2">
                <div class="card">
                  <div class="card-image">

                    <img src="{{Storage::url($transaction->imagen->nombre)}}" class="responsive-img materialboxed" alt="">
                  </div>
                  <div class="card-content" style="padding:5%">
                    <div class="row" style="margin:0;">
                      @if($transaction->estado == 1 && $transaction->id_tipo_transaccion <= 2 && $transaction->remesa->estado == 0)
                        <div class="col s12">
                          <center>
                            <button class="btn indigo">Entregada</button>
                          </center>
                        </div>
                      @else
                        <div class="col s6">
                          <center>

                            <a href="#modal-motivo-aprobacion" class="btn btn-small z-depth-1 green lighten-1 modal-trigger"><i class="material-icons">check_circle</i></a>
                              
                          </center>
                        </div>
                        <div class="col s6">
                          <center>
                            <a href="#modal-motivo-rechazo" class="btn btn-small z-depth-1 red lighten-1 modal-trigger"><i class="material-icons">cancel</i></a>
                          </center>
                        </div>
                      @endif
                    </div>
                    <center>
                    </center>
                  </div>
                </div> 
            </div>
  				</div>
          <hr>
          <div class="row">
            <table class="striped centered">
              <tr>
                <td><b>Client</b></td>
                <td>{{$transaccion->cliente->usuario->persona->nombre}} - 
                  @if($transaccion->cliente->usuario->persona->cedula != null)
                  {{$transaccion->cliente->usuario->persona->cedula}}
                  @else
                    this user hasn't completed it's profile
                  @endif
                </td>
              </tr>
              <tr>
                <td><b>Client Status</b></td>
                @if($transaccion->cliente->usuario->persona->usuario->estado == 1)
                  <td>Don't verified</td>
                @elseif($transaccion->cliente->usuario->persona->usuario->estado == 2)
                  <td>Verified</td>
                @elseif($transaccion->cliente->usuario->persona->usuario->estado == 3)
                  <td>Unactive</td>
                @endif
              </tr>     
              <tr>
                <td><b>Transaction Type</b></td>
                <td>{{$transaction->tipoTransaccion->nombre}}</td>
              </tr>

              <!--Si es una Remesa-->
              @if($transaction->id_tipo_transaccion <= 2)
                <tr>
                  <td><b>Remittance's Commission</b></td>
                  <td>{{$transaction->remesa->comision_compra}} %</td>
                </tr>
                <tr>
                  <td><b>Payment Method</b></td>
                  <td>{{$transaction->remesa->metodoPago->nombre}}</td>
                </tr>
                <tr>
                  <td><b>Retirement Method</b></td>
                  <td>{{$transaction->remesa->metodoRetiro->nombre}}</td>
                </tr>

                <!--Si es una Remesa interna-->
                @if($transaction->id_tipo_transaccion == 1)
                  <tr>
                    <td><b>Transaction</b></td>
                    <td>{{$transaction->remesa->monto}} $ to {{$transaction->remesa->remesaInterna->cliente->usuario->persona->nombre}} (<b>{{$transaction->remesa->remesaInterna->cliente->usuario->persona->cedula}}</b>)</td>
                  </tr>
                  <tr>
                    <td><b>To pay</b></td>
                    <td>{{$transaction->remesa->monto_total}} $</td>
                  </tr>
                  
                <!--Si es una Remesa externa-->
                @elseif($transaction->id_tipo_transaccion == 2)
                  <tr>
                    <td><b>Transaction</b></td>
                    <td>{{$transaction->remesa->monto}} $ to {{$transaction->remesa->remesaExterna->noUsuario->persona->nombre}} - {{$transaction->remesa->remesaExterna->noUsuario->persona->cedula}}</td>
                  </tr>
                  <tr>
                    <td><b>To pay</b></td>
                    <td>{{$transaction->remesa->monto_total}} $</td>
                  </tr>
                @endif

              <!--Si es una Compra-->
              @elseif($transaction->id_tipo_transaccion == 3)
                <tr>
                  <td><b>Pursache</b></td>
                  <td>{{$transaction->compraCriptomoneda->monto}} {{$transaction->compraCriptomoneda->haiCriptomoneda->moneda->siglas}} </td>
                </tr>
                
                <tr>
                  <td><b>{{$transaction->compraCriptomoneda->haiCriptomoneda->moneda->siglas}} Real Cost</b></td>
                  <td>{{$transaction->compraCriptomoneda->precio_moneda_a_comprar}} $</td>
                </tr>
                
                <tr>
                  <td><b>General Commission</b></td>
                  <td>{{$transaction->compraCriptomoneda->comision_general}} %</td>
                </tr>
                
                <tr>
                  <td><b>Buy Commission</b></td>
                  <td>{{$transaction->compraCriptomoneda->comision_compra}} %</td>
                </tr>
                
                <tr>
                  <td><b>Amount without commisions</b></td>
                  <td>{{$transaction->compraCriptomoneda->total_sin_comision}} {{$transaction->compraCriptomoneda->moneda->siglas}}</td>
                </tr> 

                <tr>
                  <td><b>To Pay</b></td>
                  <td>{{$transaction->compraCriptomoneda->total_con_comision}} {{$transaction->compraCriptomoneda->moneda->siglas}}
                  </td>
                </tr> 
              @endif
              
            </table>
          </div>
  			</div>
  		</div>
      <form id="form-change-state"
        @if($transaction->remesa != null)

          action="{{route('change_state_remittance')}}"

        @elseif($transaction->compraCriptomoneda != null)

          action="{{route('change_state_transaction')}}"

        @endif

        method="post" hidden>
        @csrf

        <input id="observacion" name="observacion">
        <input name="transaction_id" value="{{$transaction->id}}">
        <input id="csf-id-estado" name="id_estado">
        
      </form>
    @endif
	</div>
  <div id="modal-motivo-aprobacion" class="modal">
    <div id="modal-content" class="modal-content margin-0">
      <center><h5 id="modal-title">Are you sure you want to approve this transaction?</h5></center>
      <div class="row">
        <div class="col s12">
          <center>
              <button class="btn btn-small z-depth-1 green lighten-1 change-state" data-state="1">Do it</button>
              <button class="btn btn-small z-depth-1 red lighten-1 modal-close">Cancel</button>
          </center>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-motivo-rechazo" class="modal">
    <div id="modal-content" class="modal-content margin-0">
      <center><h5 id="modal-title">Are you sure you want to deny this transaction?</h5></center>
      <div class="row">
        <div class="col s12">
          <input type="text" id="observacion_modal" placeholder="Observation">
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <center>


              <button class="btn btn-small z-depth-1 green lighten-1 change-state" data-state="2">Do it</button>
              <button class="btn btn-small z-depth-1 red lighten-1 modal-close">Cancel</button>

          </center>
        </div>
      </div>
    </div>
  </div>

@endsection
<script>
  document.addEventListener('DOMContentLoaded',function(){
    var elems_modal = document.querySelectorAll('.modal');
    var instances_modal = M.Modal.init(elems_modal);
    	
    var elems_images = document.querySelectorAll('.materialboxed');
    var instances_iamges = M.Materialbox.init(elems_images);

    var elems_collapsible = document.querySelectorAll('.collapsible');
    var instances_collapsible = M.Collapsible.init(elems_collapsible);

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
<script type="module" src="{{asset('js/transactions/main.js')}}"></script>
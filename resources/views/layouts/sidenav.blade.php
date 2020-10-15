<?php $auth = \Auth::user(); ?>
<style>
    
    body {
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      body {
        padding-left: 0;
      }
    }
</style>
  <ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
      <div class="user-view">
        <div class="background blue lighten-4"></div>
          <a href="#user"><img class="responsive-img" src="{{asset('images/logo.png')}}"></a><br><br>
      </div>
    </li>

    <li><div class="divider"></div></li>
    @if($auth->tipo == 1)
      <!--li><a class="waves-effect" href="{{route('edit_profile')}}">Profile</a></li-->
      <li>
        <ul class="collapsible collapsible-accordion">
            <li>
              <a class="collapsible-header">Profile<i class="material-icons">arrow_drop_down</i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="{{route('edit_profile',['p'=>1])}}">Edit profile</a></li>
                  <li><a href="{{route('edit_profile',['p'=>2])}}">Portfolio</a></li>
                </ul>
              </div>
            </li>
          </ul>
      </li>
      <li><a href="{{route('dashboard_clients')}}">Buy/Sell/Exchange</a></li>

    <li>
      <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Money<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="{{route('remittances')}}">Send</a></li>
                <li><a href="{{route('my_remittances')}}">Remittances to me</a></li>
                <li><a href="{{route('verify_remittances')}}">Verify</a></li>
              </ul>
            </div>
          </li>
        </ul>
    </li>
      <li><a href="{{route('verify_payments')}}">Verify payments</a></li>

      <li><a href="#">Transactions History</a></li>

      <li><a class="waves-effect" href="{{route('watch_video')}}">Earn money</a></li>

      <li><a class="waves-effect" href="#">Referrals</a></li>

      <li><a class="waves-effect" href="#">Payment Settings</a></li>

      <li><a class="waves-effect" href="{{route('my_deposits')}}">My deposits</a></li>
      
    @else

      @if($auth->tipo == 3)

        <li><a class="waves-effect" href="{{route('users')}}">Users/Clients</a></li>
        <li><a class="waves-effect" href="{{route('comissions')}}">Set comissions</a></li>
        <li><a class="waves-effect" href="{{route('root_withdrawals')}}">Withdrawalls</a></li>

      @elseif($auth->tipo == 2)
        <li><a class="waves-effect" href="{{route('transactions')}}">Transactions</a></li>
        <li><a class="waves-effect" href="{{route('withdrawals')}}">Withdrawals</a></li>
        <li><a class="waves-effect" href="{{route('mod_deposits')}}">Deposits</a></li>
        <li><a class="waves-effect" href="{{route('clients')}}">Clients</a></li>
      @endif

      <li><a class="waves-effect" href="{{route('all_remittances')}}">Remittances</a></li>
      
    @endif



    <!--li><a class="waves-effect" href="{{route('users')}}">Users</a></li>

    <li><a class="waves-effect" href="{{route('clients')}}">Clients</a></li>


    <li><a class="waves-effect" href="{{route('transactions')}}">Transactions</a></li>

    <li>
      <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Dashboard<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="/dashboard_clients?tab=1">Buy cripto</a></li>
                <li><a href="/dashboard_clients?tab=3">Send remittance</a></li>
                <li><a href="/dashboard_clients?tab=4">My sends</a></li>
                <li><a href="/dashboard_clients?tab=5">Retire money</a></li>
              </ul>
            </div>
          </li>
        </ul>
    </li-->
    <li><a class="waves-effect" href="{{route('logout')}}">Log out</a></li>
  </ul>
  <div class="fixed-action-btn hide-on-large-only">
    
    <a data-target="slide-out" class="sidenav-trigger btn-floating indigo">
      <i class="material-icons">menu</i>
    </a>
  </div>
<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);

    var elems_colappsible = document.querySelectorAll('.collapsible');
    var instances_collapsible = M.Collapsible.init(elems_colappsible);

    var action_elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(action_elems);
  });

</script>
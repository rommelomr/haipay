  <ul id="slide-out" class="sidenav">
    <li>
      <div class="user-view">
        <div class="background blue lighten-4"></div>
          <a href="#user"><img class="responsive-img" src="{{asset('images/logo.png')}}"></a><br><br>
      </div>
    </li>

    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="{{route('edit_profile')}}">My profile</a></li>
    <li><a class="waves-effect" href="{{route('users')}}">Users</a></li>
    <li><a class="waves-effect" href="{{route('clients')}}">Clients</a></li>
    <li><a class="waves-effect" href="{{route('dashboard_clients')}}">Dashboard</a></li>
    <li><a class="waves-effect" href="{{route('watch_video')}}">Watch Video</a></li>
    <li><a class="waves-effect" href="{{route('transactions')}}">Transactions</a></li>
    <!--li>
      <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Dashboard<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">Buy cripto</a></li>
                <li><a href="#!">Verify payments</a></li>
                <li><a href="#!">Send remittance</a></li>
                <li><a href="#!">My sends</a></li>
                <li><a href="#!">Retire money</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!" style=""><i class="material-icons">arrow_drop_down</i>First</a></li>
                <li><a href="#!"></a></li>
                <li><a href="#!"></a></li>
                <li><a href="#!"></a></li>
                <li><a href="#!"></a></li>
                <li><a href="#!"></a></li>
              </ul>
            </div>
          </li>
          
        </ul>
    </li-->
  </ul>

  <div class="fixed-action-btn sidenav-trigger" data-target="slide-out">
    <a class="btn-floating btn-large indigo">
      <i class="material-icons">menu</i>
    </a>
  </div>

<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);

    var elems_colappsible = document.querySelectorAll('.collapsible');
    var instances_collapsible = M.Collapsible.init(elems_colappsible);
  });

</script>
<style>
    .btn-bar{
        color:black;
    }
</style>
<nav id="nav" class="white">
    <div class="nav-wrapper">
        <div class="brand-logo left">
            <img class="responsive-img" src="{{asset('images/logo.png')}}" alt="">
        </div>
        <ul class="right">
            <li><a href="{{route('login')}}" class="btn-bar">login</a></li>
            <li><a href="{{route('register')}}" class="btn-bar">Register</a></li>
            <li><a href="" class="btn-bar">Homepage</a></li>
        </ul>
    </div>
</nav>

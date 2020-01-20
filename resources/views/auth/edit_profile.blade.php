@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/edit_profile.css')}}">
@endsection
@section('main')
	<div class="row">
		<div class="col s10 offset-s1">
			<div class="card">
				<nav class="nav-extended indigo">
					<div class="nav-content">
						<center>
							<span class="nav-title">Edit Profile</span>
						</center>
					</div>
				</nav>
				<div class="row">
					<div class="card-content col s6">

						<form class="row" action="">
							<div class="input-field col s6">
								<label for="nombre">Name</label>
								<input id="nombre" type="text">
							</div>
							<div class="input-field col s6">
								<label for="cedula">ID</label>
								<input id="cedula" type="text">
							</div>
							<div class="input-field col s6">
								<label for="email">Email</label>
								<input id="email" type="text">
							</div>
							<div class="input-field col s6">
								<label for="password">Password</label>
								<input id="password" type="text">
							</div>
							<div class="input-field col s12">
								<label for="telephone">Telephone</label>
								<input id="telephone" type="text">
							</div>
							<div class="input-field col s12">
								<center>
									<button class="btn indigo">Save</button>
								</center>
							</div>
						</form>
					</div>
					<div class="card-content col s6">
						<nav class="green lighten-3">
							<center>
								Account Verified
							</center>
						</nav>
						<div class="row">
							<div class="col s6">
								<img src="{{asset('images/fondo_login_2.jpg')}}" class="responsive-img">
							</div>
							<div class="col s6">
								<img src="{{asset('images/fondo_login_2.jpg')}}" class="responsive-img">
							</div>

						</div>
					</div>
					<div class="card-content col s6" hidden>
						<nav class="green lighten-3">
							<center>
								Account Verified
							</center>
						</nav>
						<form class="row">
							<div class="file-field input-field">
						      <div class="btn">
						        <span>Pictures</span>
						        <input type="file" multiple>
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="Upload your pictures">
						      </div>
						    </div>
						    <div clas="col s12">
						    	<center>
						    		<button class="indigo btn">Upload</button>
						    	</center>
						    </div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
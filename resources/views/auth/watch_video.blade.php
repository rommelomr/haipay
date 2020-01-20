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
							<span class="nav-title">Watch Video</span>
						</center>
					</div>
				</nav>
				<div class="row">
					<div class="card-content col s6">
						<ul class="collection">
							<li class="collection-item">Video 1</li>
							<li class="collection-item">Video 2</li>
							<li class="collection-item">Video 3</li>
							<li class="collection-item">Video 4</li>
						</ul>
					</div>
					<div class="card-content col s6">

						<video controls="true" width="100%">
							<source src="movie.mp4" type="video/mp4">
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
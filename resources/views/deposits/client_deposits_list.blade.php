@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    
@endsection
@section('main')
    <div class="container">

    	<div class="card-panel">
    		<div class="row">
    			<div class="col s12">
    				<h5 class="center">My Deposits</h5>
    			</div>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col s12">
    				<ul class="collection">
    					@forelse($deposits as $deposit)	
    						<li class="collection-item avatar">
    							<img src="{{Storage::url($deposit->imagen)}}" alt="" class="circle responsive-image materialboxed">
    							<span class="title">{{$deposit->created_at}}</span><br>
    							<a href="{{$deposit->url}}" target="_blank">{{$deposit->url}}</a>
    								@if($deposit->estado == 0)
    									<span class="new badge grey" data-badge-caption="waiting"></span>
									@elseif($deposit->estado == 1)
    									<span class="new badge green" data-badge-caption="approved"></span>
									@elseif($deposit->estado == 2)
    									<span class="new badge red" data-badge-caption="Refused"></span>
									@endif
    							</span>
    						</li>
    					@empty
    					@endforelse
    				</ul>	
    			</div>
    		</div>
    		<div class="row">
    			<div class="col s12">
    				<center>
						{{$deposits->links('commons.pagination',[
							'paginate'=>$deposits
						])}}
    				</center>
    			</div>
    		</div>
    	</div>
    	

    </div>
@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems);
  });
</script>
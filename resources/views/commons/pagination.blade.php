@php
	if(!isset($max_buttons)){
		$total_buttons = 5;
	}else{
		$total_buttons = $max_buttons;
	}

	$current_page = $paginate->currentPage();

	$has_more_pages = $paginate->hasMorePages();

	$last_page = $paginate->lastPage();

	if($total_buttons >= $last_page){
		$total_buttons = $last_page;
		
	}
	//dd("$current_page - floor($total_buttons/2) = ".($current_page - floor($total_buttons/2)));
	if($current_page - floor($total_buttons/2)<1){
		$first_button = 1;
		$last_button = $total_buttons;

	}else{


		if($current_page + floor($total_buttons/2)>=$last_page){
			$first_button = $last_page - $total_buttons+1;
			$last_button = $last_page;
		}else{
			$first_button = $current_page - floor($total_buttons/2);
			$last_button = $current_page + floor($total_buttons/2);
			
		}

	}

	
@endphp

@if($paginate->lastPage() !== 1)
	<ul class="pagination">
		@if($current_page > 1 + floor($total_buttons/2))
		<li class="waves-effect"><a href="{{$paginate->url(1)}}"><i class="material-icons">fast_rewind</i></a></li>
		<li class="waves-effect"><a href="{{$paginate->previousPageUrl()}}"><i class="material-icons">chevron_left</i></a></li>
		@endif
		@for($i = $first_button; $i <=$last_button;$i++)
			@if($i == $current_page)
				<li class="active"><a href="{{$paginate->url($i)}}">{{$i}}</a></li>
			@else
				<li class="waves-effect"><a href="{{$paginate->url($i)}}">{{$i}}</a></li>
			@endif
		@endfor
		@if($current_page < $last_page - floor($total_buttons/2))
			<li class="waves-effect"><a href="{{$paginate->nextPageUrl()}}"><i class="material-icons">chevron_right</i></a></li>
			<li class="waves-effect"><a href="{{$paginate->url($last_page)}}"><i class="material-icons">fast_forward</i></a></li>
		@endif
	</ul>
@endif
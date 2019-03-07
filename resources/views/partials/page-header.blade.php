@php
	
	if ( !is_page_template( array( 'views/page.blade.php', 'views/404.blade.php') ) ) {
	    $headerClass = ' hero--center';	    
	} else {
	   $headerClass = false;
	}

@endphp
<div class="container--narrow inview fadeUp">
	<div class="hero {{$headerClass}}">
		<h1 class="mb-0 hero__header">{!! App::title() !!}</h1>
	</div>
</div>


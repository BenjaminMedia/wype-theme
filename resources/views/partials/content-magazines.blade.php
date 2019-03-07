@php
	$title =  get_the_title( );
	$i = 0;
@endphp
<div class="grid--overview__item inview fadeUp">
	<article class="overview">
		<figure class="overview__figure">
			@if ( has_post_thumbnail() ) 
			<a href="{{the_permalink()}}" title="{{$title}}">
				@php 
				$size = 'cover'; 
				the_post_thumbnail($size, array('class' => 'overview__img')); @endphp
			</a>
			@endif
		</figure>	
		<div class="overview__body">
			<h2 class="overview__header">
				<a href="{{the_permalink()}}" title="{{$title}}"class="overview__link">{{$title}}</a>
			</h2>
		</div>
		<a href="{{the_permalink()}}" title="{{$title}}" class="overview__overlaylink"></a>
		
	</article>
</div>
@php
	$i ++;
@endphp
@php

$args = array(
  'post_type'   => 'magazines',
  'post_status' => 'publish',
	'posts_per_page' => -1,
  
 ); 
$magazines = new WP_Query( $args );
@endphp

@if( $magazines->have_posts() ) 

  <div class="container section ">
  	<div class="grid--overview">
    
      @while( $magazines->have_posts() )
        @php
        	$magazines->the_post();
          $cover = get_field('cover_url');
        @endphp
          
          @php
          	$title =  get_the_title( );
          	$i = 0;
          @endphp
          <div class="grid--overview__item ">
          	<article class="overview inview fadeUp">
          		<figure class="overview__figure">
          			@if ( $cover ) 
          			<a href="{{the_permalink()}}" title="{{$title}}">
                  <img src="{{$cover}}" class="overview__img" alt="{{$title}}">
          			</a>
                @else 
                Please fill in cover url!
          			@endif
          		</figure>	
          		<div class="overview__body">
          			<h2 class="overview__header">
          				<a href="{{the_permalink()}}" title="{{$title}}"class="overview__link">{{$title}}</a>
          			</h2>
          		</div>
          		<a href="{{the_permalink()}}" title="{{$title}}" class="overview__overlaylink closeup-trigger" data-name="slug" data-slide="{{$i}}"></a>
          		
          	</article>
          </div>
          @php
          	$i ++;
          @endphp
        
      @endwhile
      @php
      	wp_reset_postdata();
      @endphp
      
	  </div>
	</div>
	
	@else
 
  		No magazines were found
  	
	@endif

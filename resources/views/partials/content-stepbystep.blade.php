
<div class="container--page ">
	<div class="inview fadeUp">
		<div class="page-content ">
			@php the_content() @endphp	
		</div>
	</div>
	@if (have_rows('steps'))
		<ul class="steps">
			@while ( have_rows('steps') ) @php the_row() @endphp
				@php
					$header = get_sub_field( 'headline' );
					$description = get_sub_field( 'description' );
					$image = get_sub_field( 'image' );
					$size = 'cover';
				@endphp
					<li class="steps__item inview fadeUp">
						<div class="steps__content">
							@if ($header)
							<h2 class="steps__header">
								{{$header}}
							</h2>
							@endif
							@if ($description)
							<p class="steps__description" lang="da">
								{!!$description!!}
							</p>
							@endif
						</div>

						<figure class="steps__figure">
							@if ($image)
							@php 
								echo wp_get_attachment_image( $image, $size, "", array( "class" => "steps__img" ));
							@endphp		
							@endif	
						</figure>
						
					</li>
				@endwhile	
		</ul>
	@endif		
</div>

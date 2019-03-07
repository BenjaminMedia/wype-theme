
<div class="container--slimmy inview fadeUp">

	@if (have_rows('faq_repeater'))
		<ul class="faq">
			@while ( have_rows('faq_repeater') ) @php the_row() @endphp
				@php
					$q = get_sub_field( 'question' );
					$a = get_sub_field( 'answer' );
				@endphp
					<li class="faq__item">
						<div class="faq__q js-faq" role="button">
							<h2 class="faq__header">
								{{$q}}
							</h2>
							<div class="faq__icon"></div>
						</div>
						<div class="faq__a">
							{!!$a!!}
						</div>
					</li>
				@endwhile	
		</ul>
	@endif		
</div>

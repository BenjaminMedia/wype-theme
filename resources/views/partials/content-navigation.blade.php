@if( have_rows('onboard_slider') )
<div class="onboarding">
	<div class=" js-navigation-slider">
		@while ( have_rows('onboard_slider') )  @php  	the_row()   @endphp
		@php
		$header = get_sub_field( 'header' );
		$description = get_sub_field( 'description' );
		$imagePhone = get_sub_field( 'image' );
		$imageTablet = get_sub_field( 'image_tablet' );
		$size = 'large';
		@endphp
		<div class="new-slide">
			<div class="new-slide__content new-slide__content--center">
				@if ($imagePhone)
				<figure class="mb-20 hidden-md-up">
					@php echo wp_get_attachment_image( $imagePhone, $size, "", array( "class" => "new-slide__img--sm" ))	@endphp
				</figure>
				<figure class="mb-20 hidden-sm">
					@php echo wp_get_attachment_image( $imageTablet, $size, "", array( "class" => "new-slide__img--lg" ))	@endphp
				</figure>
				@endif
				@if ($header)
				<div class="tit">
					{{$header}}
				</div>
				@endif
				@if ($description)
				<div class="text">
					{{$description}}
				</div>
				@endif
			</div>
		</div>
		@endwhile
	</div>

	<div class="onboarding__nav"></div>
</div>
@endif

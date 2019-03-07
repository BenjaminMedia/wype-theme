@if( have_rows('onboard_slider') )
	<div class="onboard">
		<div class="onboard__body">
			<div class="empty">
				<div class="onboard__slider">
					<div class="slider js-navigation-slider">
						
						@while ( have_rows('onboard_slider') )  @php  	the_row()   @endphp
						@php
							$header = get_sub_field( 'header' );
							$description = get_sub_field( 'description' );
							$imagePhone = get_sub_field( 'image' );
							$imageTablet = get_sub_field( 'image_tablet' );
							$size = 'large';
						@endphp
						<div class="slide">
							<div class="item">
								@if ($imagePhone)
									<figure class="mb-20 hidden-md-up">
										@php echo wp_get_attachment_image( $imagePhone, $size, "", array( "class" => "onboard-slider__img--sm" ))	@endphp
									</figure>
									<figure class="mb-20 hidden-sm">
										@php echo wp_get_attachment_image( $imageTablet, $size, "", array( "class" => "onboard-slider__img" ))	@endphp
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
				</div>
			</div>
			<div class="onboard__nav"></div>
		</div>
	</div>
@endif


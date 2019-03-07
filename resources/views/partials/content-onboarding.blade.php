@if( have_rows('onboard_slider') )
	<div class="onboard">
		<div class="onboard__body">
			<div class="empty">
				<div class="onboard__slider">
					<div class="slider js-onboarding-slider">
						@while ( have_rows('onboard_slider') )  @php  	the_row()   @endphp
						@php
							$icon = get_sub_field( 'icon' );
							$header = get_sub_field( 'header' );
							$description = get_sub_field( 'description' );
						@endphp
						<div class="slide">
							<div class="item">
								@if ($icon)
								<div class="ico">
									{!!$icon!!}
								</div>	
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


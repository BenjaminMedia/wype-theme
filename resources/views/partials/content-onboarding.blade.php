@if( have_rows('onboard_slider') )

<div class="onboarding">
	<div class="js-onboarding-slider">
		@while ( have_rows('onboard_slider') )  @php  	the_row()   @endphp
		@php
		$icon = get_sub_field( 'icon' );
		$header = get_sub_field( 'header' );
		$description = get_sub_field( 'description' );
		@endphp
		<div class="new-slide">
			<div class="new-slide__content">
				<div class="new-slide__item">
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
		</div>
		@endwhile
	</div>
	<div class="onboarding__nav"></div>	
</div>

@endif

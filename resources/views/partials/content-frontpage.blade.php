

@if( have_rows('flexible_blocks') )
	@while(have_rows('flexible_blocks')) @php the_row() @endphp

		@if(get_row_layout() == "hero")

			<div class="container inview fadeUp">
				<div class="hero">
					<p class="hero__summary">
						{{the_sub_field('hero_content')}}
					</p>
					<p class="hidden-md-up text-center">
						<a href="#" class="btn btn--primary">Prøv en måned gratis</a>
					</p>
				</div>
			</div>

		@elseif(get_row_layout() == "cover_slider")

			@if( have_rows('slider') )
				<div class="container section inview fadeUp">
					<div class="top-slider__arrows-container">
						<div class="top-slider__container">
							@while ( have_rows('slider') )  @php  	the_row()   @endphp
							@php
								$size = 'cover';
								$image 	= get_sub_field('image');
								$header = get_sub_field( 'header');
								$description = get_sub_field( 'description');
								$button_text = get_sub_field( 'button_text');
								$link = get_sub_field( 'link');
							@endphp
								<div class="top-slider">
									<div class="top-slider__grid">
										
										<div class="grid-item top-slider__cover">
											<figure class="top-slider__figure">
												<img src="{{$image}}" alt="{{$header}}" class="top-slider__img">
											</figure>
										</div>
										<div class="grid-item top-slider__text">
											<h2 class="top-slider__header">{{$header}}</h2>
											<p class="top-slider__summary">{{$description}}</p>
											<div>
												<a href="{{$btn_link}}" class="btn btn--primary btn--wide">{{$button_text}}</a>
											</div>
										</div>
									</div>
								</div>
							@endwhile

						</div>
					</div>
				</div>
			@endif {{-- slider --}}

		@elseif(get_row_layout() == "deck_1_free_month")
			
			@php
				$header = get_sub_field('header');
				$text = get_sub_field('text');
				$button_text = get_sub_field('button_text');
				$link = get_sub_field('link');
			@endphp

			<div class="container--narrow section">
				<div class="deck inview">
					<div class="grid-2-cols-b ">
						<div class="grid-item delay-1 slideFromLeft ">
							<h2 class="header-900">{{$header}}</h2> 
						</div>
						<div class="grid-item delay-2 slideFromRight">
							<p>{!!$text!!}</p>
							<p><a href="{{$link}}" class="btn btn--primary btn--wide">{{$button_text}}</a></p>
						</div>
					</div>
				</div>
			</div>

		@elseif(get_row_layout() == "wype_advantages")
			

			@php
				$header = get_sub_field('header');
				$subheader = get_sub_field('subheader');
			@endphp


			<div class="deck--black ">
				<div class="container--narrow">
					<div class="grid-2-cols-a ">
						<div class="grid-item  inview fadeUp">
							<h2 class="header-500">{{$header}}</h2>
							<p>{{$subheader}}</p>
						</div>
						
						@if( have_rows('advantages_repeater') )
						@php
							$counter = 0;
						@endphp
							<div class="grid-item">
								<div class="feature inview">
									
									@while ( have_rows('advantages_repeater') )  @php  	the_row()   @endphp
										@php
											$icon = get_sub_field('icon');
											$header = get_sub_field('header');
											$description = get_sub_field('description');
											$counter ++;
											if($icon == 'present') {
												$iconSize = 'feature__icon--sm';
											} elseif ($icon == 'balloon') {
												$iconSize = 'feature__icon--lg';
											}
											else {
												$iconSize = false;	
											}
										@endphp

										<div class="feature__item fadeUp delay-{{$counter}}">
											<svg class="feature__icon {{$iconSize}}"><use xlink:href="#{{$icon}}"></use></svg>
											<h3 class="feature__headline">{{$header}}</h3>
											<p class="feature__summary">{{$description}}</p>
										</div>

									@endwhile
									</div>
								</div>	
							@endif

							
					</div>
				</div>
			</div>
			
		@elseif(get_row_layout() == "deck_see_all_magazines")
			@php
				$btn_text = get_sub_field( 'button_text' );
				$btn_link = get_sub_field( 'button_link' );
				$magazine_1 = get_sub_field('magazine_1');
				$magazine_2 = get_sub_field('magazine_2');
				$magazine_3 = get_sub_field('magazine_3');
				$magazine_4 = get_sub_field('magazine_4');
				$magazine_5 = get_sub_field('magazine_5');
				$magazines = array ($magazine_1, $magazine_2, $magazine_3, $magazine_4, $magazine_5);
				$size = 'cover';
			@endphp


			<div class="mag__deck  ">
				<div class="container">
					<div class="mag__overflow">
						<div class="mag__container">
							
							@for ($i = 0; $i < 5; $i++)
							<figure class="mag__item inview">
								<img src="@php echo $magazines[$i];	@endphp" class="mag__img" width="200" height="265" alt="{{$btn_text}}">
								<a href="magazines.php" class="mag__link" title="{{$btn_text}}"></a>
							</figure>
							@endfor

						</div>
					</div>
					<div class="mag__cta inview fadeUp">
						<a href="{{$btn_link}}" class="btn btn--primary" role="button">{{$btn_text}}</a>
					</div>
				</div>
			</div>


		@elseif(get_row_layout() == "feature_slider")
			
			@php
				$header = get_sub_field('header');
			@endphp

			<div class="bottom-slider">
				<div class="container">
					<div class="bottom-slider__container ">
						<div class="bottom-slider__text inview slideFromLeft delay-1">
							<h2 class="bottom-slider__header">{{$header}}</h2>
							<div class="bottom-slider__text-content">
								
								@if( have_rows('slides') )
									<div class="bottom-slider__left">
										@while ( have_rows('slides') )  @php  the_row()   @endphp
											@php
												$header 			= get_sub_field('slide_header');
												$description 	= get_sub_field('description');
											@endphp
											<div class="slide-item">
												<p class="bottom-slider__subheader">{{$header}}</p>
												<p class="bottom-slider__summary">{{$description}}</p>
											</div>
										@endwhile
									</div>
								@endif	
								<div class="bottom-slider__dots"></div>
							</div>
						</div>
						<div class="bottom-slider__illu inview slideFromRight delay-2">
							<div class="bottom-slider__figure">
								@if( have_rows('slides') )
									<div class="bottom-slider__right">
										@while ( have_rows('slides') ) @php the_row() @endphp
											@php 
												$size = 'cover';
												$feature_image 	= get_sub_field('feature_image');
											@endphp
											<figure>
												@php 
													echo wp_get_attachment_image( $feature_image, $size, "", array( "class" => "" ));
												@endphp			
											</figure>
										@endwhile
									</div>		
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

		@elseif(get_row_layout() == "deck_get_wype")
			
			@php
				$image 		= get_sub_field('image');
				$size 		= 'full';
				$header 	= get_sub_field('header');
				$description 	= get_sub_field('description');
				$apple_btn 		= get_sub_field('apple_button_content');
				$google_btn 	= get_sub_field('google_button_content');
				$apple_link 	= get_sub_field('apple_link');
				$google_link 	= get_sub_field('google_link');
			@endphp
			<div class="deck--white ">
				<div class="container--narrow">
					<div class="getwype">
						<div class="grid-item getwype__illu inview slideFromLeft">
							<figure class="getwype__figure">
								@php 
									echo wp_get_attachment_image( $image, $size, "", array( "class" => "getwype__illu" ));
								@endphp			
							</figure>
						</div>

						<div class="grid-item getwype__content inview slideFromRight delay-2">
							<h2 class="getwype__header">{{$header}}</h2>
							<p class="getwype__summary">{!!$description!!}</p>
							
							<p>
								<a href="{{$apple_link}}" target="_blank" class="appstore-btn ">
										<span class="appstore-btn__icon">
											<svg class=" appstore-btn__icon--apple">
												<use xlink:href="#apple"></use>
											</svg>	
										</span>
										<span class="appstore-btn__text">
											{!!$apple_btn!!}
										</span>
								</a>
							</p>

							<p>
								<a href="{{$google_link}}" target="_blank" class="appstore-btn ">
										<span class="appstore-btn__icon">
											<svg class="appstore-btn__icon--google">
												<use xlink:href="#google"></use>
											</svg>	
										</span>
										<span class="appstore-btn__text">
											{!!$google_btn!!}
										</span>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>


		@elseif(get_row_layout() == "deck_print_subscribers")
			@php
				
				$header = get_sub_field( 'header' );
				$description = get_sub_field( 'description' );
				$list = get_sub_field( 'bullet_list' );

			@endphp
			<div class="deck--gray">
				<div class="container ">
					<div class="upsell inview fadeUp delay-1">
						<h2 class="upsell__header">
							{{$header}}
						</h2>
						<p class="upsell__summary">
							{{$description}}
						</p>
					</div>
					
					@if( have_rows('bullet_list') )
						@php
							$i = 0;
						@endphp
						<div class="flex-center">
							<div class="upsell-list inview">
								
								@while ( have_rows('bullet_list') ) @php the_row() @endphp

								@php
									$icon = get_sub_field( 'icon' );
									$text = get_sub_field( 'text' );
								@endphp
							
									<div class="upsell-list__item fadeUp delay-{{$i}}">
										<div class="upsell-list__illu">
											<svg class="upsell-list__icon">
												<use xlink:href="#{{$icon}}"></use>
											</svg>			
										</div>
										<div class="upsell-list__text">
											{{$text}}
										</div>
									</div>
								@php
									$i ++;
								@endphp
								@endwhile

							</div>
						</div>
					
					@endif

				</div>
			</div>


		@endif {{-- Decks --}}


	@endwhile {{-- flexible blocks --}}
@endif {{-- flexible blocks --}}






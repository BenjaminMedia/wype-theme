<div class="promo-header promo-header--hidden">
	@php
	$promo_header_text = get_field( 'promo_header_text', 'options' );
	$promo_header_link = get_field( 'promo_header_link', 'options' );
	@endphp
	<a href="{{$promo_header_link}}" class="promo-header__link" tabindex="-1">{{$promo_header_text}}</a>
</div>

<div class="header__container inview">
	<div class="container">
		<header class="header">
			
			<a href="{{ home_url('/') }}" class="header__logo-link" title="{{ get_bloginfo('name', 'display') }}" tabindex="0">
				<svg class="header__logo">
					<use xlink:href="#wype"></use>
				</svg>
			</a>

			<nav class="header__menu">
				@if (has_nav_menu('primary_navigation'))
				{!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'menu']) !!}
				@endif
			</nav>

			@php
			$btn_text = get_field( 'header_button_text', 'options' );
			$btn_link = get_field( 'header_button_link', 'options' );
			@endphp
			<div class="header__cta hidden-sm">
				<a href="{{$btn_link}}" target="_blank" class="btn btn--primary">{{$btn_text}}</a>
			</div>
			<div class="header__menu-icon hidden-md-up">
				<button type="button" aria-label="Menu" aria-controls="navigation" class="hamburger hamburger--wype js-nav-toggle">
					<span class="hamburger-box"><span class="hamburger-inner"></span></span>
				</button>
			</div>
		</header>
	</div>
</div>
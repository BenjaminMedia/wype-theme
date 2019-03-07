<footer class="deck--black">
	<div class="container">
		<div class="footer">
			<div class="footer__wide">
				<a href="/" class="footer__logo-link" title="Gå til Wype forside">
					<svg class="footer__logo">
						<use xlink:href="#wype"></use>
					</svg>
				</a>
			</div>

			<div class="footer__item inview fadeUp delay-1">
				@php dynamic_sidebar('footer-1') @endphp
			</div>
			<div class="footer__item inview fadeUp delay-2">
				@php dynamic_sidebar('footer-2') @endphp
			</div>
			<div class="footer__item inview fadeUp delay-3">
				@php dynamic_sidebar('footer-3') @endphp
			</div>
			<div class="footer__item inview fadeUp delay-4">
				@php dynamic_sidebar('footer-4') @endphp
			</div>

			<div class="footer__wide inview fadeUp delay-5">
				
					@php dynamic_sidebar('footer-bottom') @endphp
				
			</div>
		</div>
	</div>
</footer>


<div class="container--page inview fadeUp">
	<div class="page-content ">
		@php the_content() @endphp	
	</div>
</div>

{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
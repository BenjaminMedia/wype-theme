@php
  $cover = get_field('cover_url');
@endphp

<article @php post_class() @endphp>
  <div class="closeup">
    <div class="closeup-slider" >
      <div class="slide" >
        <div class="container--narrow">
          
          <div class="grid-overview-slider">
            
            <div class=" grid-overview-slider__cover inview fadeUp delay-1">
              @if ($cover)
              <figure class="grid-overview-slider__figure">
                <div>
                <img src="{{$cover}}" class="grid-overview-slider__img" alt="{{get_the_title()}}">
                </div>
              </figure>
              @else 
              Link to cover is missing!
              @endif
            </div><!-- .half -->
            
            <div class="grid-overview-slider__content inview fadeUp delay-2" >
              <article class="closeup__content">
                <h1 class="closeup__header">{{ get_the_title() }}</h1>
                @php the_content() @endphp

               
               <footer>
                 <div class="slider-nav">
                   <div class="prev-link slider-nav__arrow slider-nav__arrow--prev">
                     
                     @php
                       c2c_next_or_loop_post_link('%link','<svg class="slider-nav__icon slider-nav__icon--prev"><use xlink:href="#icon-prev"></use></svg><span class="label-text" title="%title">%title</span>');
                     @endphp
                   </div>
                  @php
                    $overview_button_link = get_field( 'overview_button_link', 'options' );
                  @endphp
                  @if ($overview_button_link)
                   <a href="{{$overview_button_link['url']}}" class="slider-nav__overview">
                     <svg class="slider-nav__overview-icon ">
                       <use xlink:href="#overview"></use>
                     </svg><span class="label-text">{{$overview_button_link['title']}}</span>
                   </a>


                   @else 
                      <a href="/wp/wp-admin/admin.php?page=theme-general-settings">Udfyld oversigtslink!</a>
                   @endif


                   <div class="next-link slider-nav__arrow slider-nav__arrow--next">
                     @php
                       c2c_previous_or_loop_post_link('%link','<span class="label-text" title="%title">%title</span><svg class="slider-nav__icon slider-nav__icon--next "><use xlink:href="#icon-next"></use></svg>');
                     @endphp
                     
                     
                   </div>


                 </div>
               </footer>

              </article><!-- .text-wrap -->
            </div><!-- .grid-item -->

          </div><!-- .grid -->
        </div><!-- .container -->
      </div><!-- .slide -->

    </div><!-- .person-slider -->
  </div><!-- .closeup --> 
  
</article>

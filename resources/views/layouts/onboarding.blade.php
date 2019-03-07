<!doctype html>
<html class="no-js" {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    
    
          @yield('content')
    
    
    @include('partials.sprite')
    @php wp_footer() @endphp
  </body>
</html>

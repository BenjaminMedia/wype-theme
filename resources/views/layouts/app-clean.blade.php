<!doctype html>
<html class="no-js" {!! get_language_attributes() !!}>
@include('partials.head')
@php
    add_filter( 'body_class', function( $classes ) {
        return array_merge( $classes, array( 'template-form' ) );
    } );
@endphp
<body @php body_class() @endphp>
@include('partials.sprite')
<div class="wrap" role="document">
    <div class="content">
        <main class="main">
            @if ($step == 2)
                @yield('content_step_2')
            @elseif ($step == 3)
                @yield('content_success')
            @else
                @yield('content_step_1')
            @endif
        </main>
    </div>
</div>
</body>
</html>

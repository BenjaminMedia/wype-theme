{{--
  Template Name: Frontpage
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-frontpage')
  @endwhile
@endsection

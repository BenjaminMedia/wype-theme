{{--
  Template Name: App - Navigation
--}}


@extends('layouts.onboarding')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-navigation')
  @endwhile
@endsection

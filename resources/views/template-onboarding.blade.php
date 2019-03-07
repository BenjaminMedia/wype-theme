{{--
  Template Name: App - Onboarding
--}}


@extends('layouts.onboarding')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-onboarding')
  @endwhile
@endsection

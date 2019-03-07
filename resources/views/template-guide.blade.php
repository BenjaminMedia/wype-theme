{{--
  Template Name: Step-by-step guide
--}}
@php
	
@endphp

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-stepbystep')
  @endwhile
@endsection

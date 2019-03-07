{{--
  Template Name: Magazines overview
--}}
@php
	
@endphp

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-magazines-overview')
  @endwhile
@endsection

@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
	  <div class="container--page inview fadeUp ">
	  	<div class="page-content">
		    <div class="text-center">
		    	{{the_field( '404_body', 'options' )}}
		    </div>
	    </div>

    </div>
  @endif
@endsection

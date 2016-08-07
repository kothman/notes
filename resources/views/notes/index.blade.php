@extends('layouts.app')

@section('content')

    <div class="container">
	<div class="row row-actions">
	    <div class="col-xs-12 text-right">
		<a class="btn btn-primary" href="{{ url('/notes/create/' . $notebook->id) }}">
		    <i class="fa fa-plus" aria-hidden="true"></i> New Note
		</a>
	    </div>
	</div>
	<div class="row">
	    @foreach ($notes as $n)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
		    <div class="panel panel-primary">
			<div class="panel-heading">
			    <a href="{{ url('/notes/view/' . $n->id) }}">{{ $n->title }}</a>
			    <a href="{{ url('/notes/edit/' . $n->id) }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
			</div>
			<div class="panel-body note-preview">
			    <p>{!! $n->text !!}</p>
			    <div class="fader"></div>
			</div>
		    </div>
		</div>
	    @endforeach
	</div>
    </div>

@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
		    <div class="panel-heading">
			<a href="{{ url('/notebooks') }}">View All</a>
			@if (!empty($notebook->id))
			    @if (isset($edit))
				<a href="{{ url('/notebooks/view/' . $notebook->id) }}" class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
			    @else
				<a href="{{ url('/notebooks/edit/' . $notebook->id) }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
			    @endif
			@endif
		    </div>
		    <div class="panel-body">
			@if (!empty($notebook->id) && $notebook->trashed())
			    <h3>This record was deleted at {{ date("F j, Y, g:i a",strtotime($notebook->deleted_at)) }}</h3>
			@endif
			{!! form($form) !!}
		    </div>
		    @if (!empty($notebook->id))
			<div class="panel-footer">
			    
			    @if ($notebook->trashed())
				<a href="{{ url('/notebooks/restore/' . $notebook->id) }}">Restore this record</a>
			    @else
				<a href="{{ url('/notebooks/delete/' . $notebook->id) }}">Delete this record (can be undone)</a>
			    @endif
			</div>
		    @endif
		</div>
	    </div>
	</div>
    </div>
@endsection

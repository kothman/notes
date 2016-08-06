@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
	    @if (count($notebooks))
		@foreach ($notebooks as $notebook)
		    <div class="panel panel-primary">
			<div class="panel-heading">
			    <a href="{{ url('/notebooks/notes/' . $notebook->id) }}"><i class="fa fa-book" aria-hidden="true"></i> {{ $notebook->title }}</a>
			    <a href="{{ url('/') }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Add Note</a>
			</div>
			
			<div class="panel-body">
			    <p>{{ $notebook->description }}</p>
			    <div class="row">
				@foreach ($notebook->notes() as $note)
				    <div class="col-xs-12 col-sm-6 col-md-4">
					<div class="panel panel-info">
					    <div class="panel-heading">{{ $note->title }}</div>
					    <div class="panel-body">
					    </div>
					</div>
				    </div>
				@endforeach
			    </div> <!-- End Row -->
			    
			</div>
			<div class="panel-footer text-right">
			    <a href="{{ url('/notebooks/edit/' . $notebook->id) }}">Edit This Notebook</a>
			</div>
		    </div>
		@endforeach
	    @else
		<div class="panel panel-primary">
		    <div class="panel-heading"></div>
		    <div class="panel-body">
			<h3>It looks like you haven't created any notebooks yet. Want to <a href="{{ url('/notebooks/create') }}">create one now</a>?</h3>
		    </div>
		</div>
	    @endif
	</div>
    </div>
</div>

@endsection

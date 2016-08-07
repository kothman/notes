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
			    <a href="{{ url('/notes/create/' . $notebook->id) }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Add Note</a>
			</div>
			
			<div class="panel-body">
			    <p>{{ $notebook->description }}</p>
			    <div class="row">
				@if (count($notebook->notes) === 0)
				    <div class="col-xs-12">
					<div class="panel panel-info">
					    <div class="panel-heading"></div>
					    <div class="panel-body">
						<h4>It looks like you haven't added any notes yet. Would you like to <a href="/notes/create/{{ $notebook->id }}">add one now?</a></h4>
					    </div>
					</div>
				    </div>
				@endif
				@foreach ($notebook->notes as $note)
				    <div class="col-xs-12 col-sm-6 col-md-4">
					<div class="panel panel-info">
					    <div class="panel-heading">
						<a href="/notes/view/{{ $note->id }}">{{ $note->title }}</a>
						<a href="/notes/edit/{{ $note->id }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
					    </div>
					    <div class="panel-body note-preview">
						{!! $note->text !!}
						<div class="fader"></div>
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

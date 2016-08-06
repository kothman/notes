@extends('layouts.app')

@section('content')

    <div class="container">
	<div class="row row-actions">
	    <div class="col-xs-12 text-right">
		<a class="btn btn-primary" href="{{ url('/notebooks/create') }}">
		    <i class="fa fa-plus" aria-hidden="true"></i> New Notebook
		</a>
	    </div>
	</div>
	<div class="row">
	    @foreach ($notebooks as $notebook)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
		    <div class="panel panel-primary">
			<div class="panel-heading">
			    <a href="{{ url('/notebooks/notes/' . $notebook->id) }}">{{ $notebook->title }}</a>
			    <a href="{{ url('/notebooks/edit/' . $notebook->id) }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
			</div>
			<div class="panel-body">
			    <div class="row row-actions text-right">
				<div class="col-xs-12">
				    <a href="/notes/create/{{ $notebook->id }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> New Note</button></a>
				</div>
			    </div>
			    <p>{{ $notebook->description }}</p>
			</div>
			    @if (count($notebook->notes))
				<ul class="list-group">
				    @foreach($notebook->notes as $note)
					<a href="/notes/view/{{ $note->id }}"><li class="list-group-item">{{ $note->title }}</li></a>
				    @endforeach
				</ul>
			    @endif
			    <div class="panel-footer">

			    </div>
		    </div>
		</div>
	    @endforeach
	</div>
    </div>

@endsection

@extends('layouts.app')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
     tinymce.init({
	 selector:'textarea:not([disabled])',
	 plugins: "autoresize,autosave,autolink,fullscreen,image,imagetools,spellchecker",
	 statusbar: false
     });
    </script>
@endsection

@section('content')
    <div class="container" id="app">
	<div class="row">
	    <div class="col-xs-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">
			<div class="panel-title">
			    <a href="/notebooks/view/{{ $notebook->id }}">{{ $notebook->title }}</a>- @{{ title }}
			</div>
			<a href="{{ url('/notebooks/notes/' . $notebook->id) }}">View All</a>
			@if (!empty($note->id))
			    @if (isset($edit))
				<a href="{{ url('/notes/view/' . $note->id) }}" class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
			    @else
				<a href="{{ url('/notes/edit/' . $note->id) }}" class="pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
			    @endif
			@endif
		    </div>
		    <div class="panel-body">
			@if (!empty($note->id) && $note->trashed())
			    <h3>This record was deleted on {{ date("F j, Y, g:i a",strtotime($note->deleted_at)) }}</h3>
			@endif
			{!! form($form) !!}
		    </div>
		    @if (!empty($note->id))
			<div class="panel-footer">
			    
			    @if ($note->trashed())
				<a href="{{ url('/notes/restore/' . $note->id) }}">Restore this record</a>
			    @else
				<a href="{{ url('/notes/delete/' . $note->id) }}">Delete this record (can be undone)</a>
			    @endif
			</div>
		    @endif
		</div>
	    </div>
	</div>
    </div>

    <script>
     
     new Vue({
	 el: "#app",
	 data: {
	     title: "Note Title"
	 }
     });

    </script>
@endsection

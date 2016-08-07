@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
	<div class="col-xs-12 col-sm-8 col-offset-sm-2 col-md-6 col-md-offset-3">
	    <div class="panel panel-primary">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
		    {!! form($form) !!}
		</div>
	    </div>
	</div>
    </div>
</div>

@endsection

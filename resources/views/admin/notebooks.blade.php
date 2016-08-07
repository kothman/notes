@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
	<div class="col-xs-12">
	    <table class="table">
		<thead>
		    <tr>
			<th>Id</th>
			<th>Name</th>
			<th>User</th>
			<th>Actions</th>
		    </tr>
		</thead>
		<tbody>
		    @foreach($notebooks as $n)
			<tr>
			    <td>{{ $n->id }}</td>
			    <td>{{ $n->title }}</td>
			    <td><a href="/admin/users/view/{{ $n->user->id }}">{{ $n->user->email }}</a></td>
			    <td><a href="/admin/notebooks/view/{{ $n->id }}">View/Edit</a></td>
			</tr>
		    @endforeach
		</tbody>
	    </table>
	</div>
    </div>
</div>

@endsection

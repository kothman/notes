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
			<th>Notebook</th>
			<th>User</th>
			<th>Actions</th>
		    </tr>
		</thead>
		<tbody>
		    @foreach($notes as $n)
			<tr>
			    <td>{{ $n->id }}</td>
			    <td>{{ $n->title }}</td>
			    <td><a href="/admin/notebooks/view/{{ $n->notebook->id }}">{{ $n->notebook->title }}</a></td>
			    <td><a href="/admin/users/view/{{ $n->notebook->user->id }}">{{ $n->notebook->user->email }}</a></td>
			    <td><a href="/admin/notes/view/{{ $n->id }}">View/Edit</a></td>
			</tr>
		    @endforeach
		</tbody>
	    </table>
	</div>
    </div>
</div>

@endsection

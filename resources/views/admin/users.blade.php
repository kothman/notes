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
			<th>Email</th>
			<th>Actions</th>
		    </tr>
		</thead>
		<tbody>
		    @foreach($users as $u)
			<tr>
			    <td>{{ $u->id }}</td>
			    <td>{{ $u->first }} {{ $u->last }}</td>
			    <td>{{ $u->email }}</td>
			    <td><a href="/admin/users/view/{{ $u->id }}">View/Edit</a></td>
			</tr>
		    @endforeach
		</tbody>
	    </table>
	</div>
    </div>
</div>

@endsection
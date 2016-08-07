@extends('layouts.app')

@section('content')

<div class="container" id="app">
    <div class="row">
	<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
	    <div class="panel panel-primary">
		<div class="panel-heading">
		    @{{ first }} @{{ last }} - @{{ email }}
		</div>
		<div class="panel-body">
		    {!! form($form) !!}
		</div>
		<div class="panel-body">
		    {!! form($passwordForm) !!}
		</div>
		<div class="panel-body">
		    {!! form($emailForm) !!}
		</div>
	    </div>
	</div>
    </div>
</div>

<script>

 (function () {
     var confirmationField = document.querySelector("[name='password_confirmation']");
     var parent = confirmationField.parentElement;
     var fieldCopy = confirmationField.cloneNode();
     var inputGroup = document.createElement("div");
     inputGroup.setAttribute("class", "input-group");
     var inputGroupAddon = document.createElement("div");
     inputGroupAddon.setAttribute("class", "input-group-addon");
     var indicator = document.createElement("i");
     indicator.setAttribute("class", "fa fa-@{{ password == password_confirmation ? 'check' : 'remove' }}");
     indicator.setAttribute("style", "@{{ password == '' || password_confirmation == '' ? 'display: none;' : '' }}");
     inputGroupAddon.appendChild(indicator);
     inputGroup.appendChild(fieldCopy);
     inputGroup.appendChild(inputGroupAddon);
     parent.replaceChild(inputGroup, confirmationField);
 })();
     new Vue({
     el: "#app",
     data: {
	 first: '',
	 last: '',
	 password: '',
	 password_confirmation: '',
	 email: ''
     }
 });
</script>

@endsection

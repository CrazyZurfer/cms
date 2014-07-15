{{ Form::open(['route' => ['dev.definitions.destroy', $definition->id], 'method' => 'delete']) }}

<p><b>Are you sure you want to delete this definition?</b></p>
<hr>
<div class="pull-right">
	<a class="btn btn-default" href="{{ URL::route('dev.definitions.show', $definition->id) }}">Cancel</a>
	<button class="btn btn-danger">Delete</button>
</div>

{{ Form::close() }}
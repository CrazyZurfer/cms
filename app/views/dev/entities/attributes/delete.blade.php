{{ Form::open(['route' => ['dev.entities.attributes.destroy', $entity->id, $attribute->id], 'method' => 'delete']) }}

<p><b>Are you sure you want to delete this attribute?</b></p>
<hr>
<div class="pull-right">
	<a class="btn btn-default" href="{{ URL::route('dev.entities.show', $entity->id) }}">Cancel</a>
	<button class="btn btn-danger">Delete</button>
</div>

{{ Form::close() }}
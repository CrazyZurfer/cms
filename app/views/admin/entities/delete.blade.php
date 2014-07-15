{{ Form::open(['route' => ['admin.' . $entity->route_name . '.destroy', $item->id], 'method' => 'delete']) }}

<p><b>Are you sure you want to delete this {{ $entity->name }}?</b></p>
<hr>
<div class="pull-right">
	<a class="btn btn-default" href="{{ URL::route('admin.' . $entity->route_name . '.show', $item->id) }}">Cancel</a>
	<button class="btn btn-danger">Delete</button>
</div>

{{ Form::close() }}
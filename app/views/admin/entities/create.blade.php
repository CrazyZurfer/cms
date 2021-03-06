{{ Form::open(['route' => 'admin.' . $entity->route_name . '.store', 'files' => true]) }}

@if ($entity->has_slug == 'slug')
	<div class="form-group">
		<label>Slug</label>
		<p class="help-block">Replaces the id</p>
		<input class="form-control" name="slug" value="{{ Input::old('slug') }}">
		{{ $errors->first('slug', '<br><div class="alert alert-danger">:message</div>') }}
	</div>
@endif

@foreach ($entity->attributes as $index => $attribute)
	@if ($attribute->type == 'string')
		<div class="form-group">
			<label>{{ ucfirst($attribute->name) }}</label>
			<p class="help-block">{{ $attribute->description }}</p>
			<input class="form-control" name="{{ $attribute->name }}" value="{{ Input::old($attribute->name) }}">
			{{ $errors->first($attribute->name, '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	@endif
	@if ($attribute->type == 'text')
		<div class="form-group">
			<label>{{ ucfirst($attribute->name) }}</label>
			<p class="help-block">{{ $attribute->description }}</p>
			<textarea class="form-control" name="{{ $attribute->name }}">{{ Input::old($attribute->name) }}</textarea>
			{{ $errors->first($attribute->name, '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	@endif
	@if ($attribute->type == 'markdown')
		<div class="form-group">
			<label>{{ ucfirst($attribute->name) }}</label>
			<p class="help-block">{{ $attribute->description }}</p>
			<textarea class="form-control" name="{{ $attribute->name }}" data-provide="markdown" data-iconlibrary="fa" rows="10">{{ Input::old($attribute->name) }}</textarea>
			{{ $errors->first($attribute->name, '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	@endif
	@if ($attribute->type == 'integer')
		<div class="form-group">
			<label>{{ ucfirst($attribute->name) }}</label>
			<p class="help-block">{{ $attribute->description }}</p>
			<textarea class="form-control" name="{{ $attribute->name }}">{{ Input::old($attribute->name) }}</textarea>
			{{ $errors->first($attribute->name, '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	@endif
	@if ($attribute->type == 'image')
		<div class="form-group">
			<label>{{ ucfirst($attribute->name) }}</label>
			<p class="help-block">{{ $attribute->description }}</p>
			<div>
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
					<div>
						<span class="btn btn-default btn-file">
							<span class="fileinput-new">Select image</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="{{ $attribute->name }}">
						</span>
						<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
			{{ $errors->first('file', '<br><div class="alert alert-danger">:message</div>') }}
			{{ $errors->first($attribute->name, '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	@endif
@endforeach

<hr>
<div class="pull-right">
	<a class="btn btn-default" href="{{ URL::route('admin.' . $entity->route_name . '.index') }}">Cancel</a>
	<button class="btn btn-primary">Save</button>
</div>

{{ Form::close() }}
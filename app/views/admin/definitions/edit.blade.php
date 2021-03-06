{{ Form::open(['route' => ['admin.definitions.update', $definition->id], 'method' => 'put', 'files' => true]) }}

<p><b>{{ $definition->identifier }}</b></p>
<p>
	<span class="text-muted">{{ $definition->description }}</span>
</p>
<hr>
		
@if ($definition->type == 'string')


<div class="form-group">
	<label>{{ $definition->identifier }}</label>
	<input type="text" class="form-control" name="string" value="{{ $definition->string }}">
	{{ $errors->first('string', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'code')

<div class="form-group">
	<label>{{ trans('admin.Value') }}</label>
	<textarea class="form-control" name="code" style="display:none">{{{ $definition->code }}}</textarea>
	<div class="editor" id="code"/>
	{{ $errors->first('code', '<br><div class="alert alert-danger">:message</div>') }}

	<script>
	    var editor = ace.edit("code");
		var textarea = $('textarea[name="code"]').hide();
		editor.getSession().setValue(textarea.val());
		editor.getSession().on('change', function(){
		  textarea.val(editor.getSession().getValue());
		});
	</script>
	<style type="text/css">
	.editor {
		height: 200px;
	}
	</style>
</div>

@elseif ($definition->type == 'text')

<div class="form-group">
	<label>{{ $definition->identifier }}</label>
	<textarea class="form-control" name="text">{{ $definition->text }}</textarea>
	{{ $errors->first('text', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'integer')

<div class="form-group">
	<label>{{ $definition->identifier }}</label>
	<input type="text" class="form-control" name="integer" value="{{ $definition->integer }}">
	{{ $errors->first('integer', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'boolean')

<div class="form-group">
	<label>{{ trans('admin.Value') }}</label>
	<select class="form-control" name="boolean">
		<option value=1 {{ $definition->boolean ? 'selected' : '' }}>{{ trans('admin.Yes') }}</option>
		<option value=0 {{ $definition->boolean ? '' : 'selected' }}>{{ trans('admin.No') }}</option>
	</select>
	{{ $errors->first('boolean', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'image')

<div class="form-group">
	<label>{{ $definition->identifier }}</label>
	<div>
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
			<div>
				<span class="btn btn-default btn-file">
					<span class="fileinput-new">{{ trans('admin.Select_Image') }}</span>
					<span class="fileinput-exists">{{ trans('admin.Change') }}</span>
					<input type="file" name="file">
				</span>
				<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{{ trans('admin.Delete') }}</a>
			</div>
		</div>
	</div>
	{{ $errors->first('file', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@endif

<hr>
<div class="pull-right">
	<a class="btn btn-default" href="{{ URL::route('dev.definitions.index') }}">{{ trans('admin.Cancel') }}</a>
	<button class="btn btn-primary">{{ trans('admin.Save') }}</button>
</div>

{{ Form::close() }}
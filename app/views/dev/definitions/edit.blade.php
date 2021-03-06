{{ Form::open(['route' => ['dev.definitions.update', $definition->id], 'method' => 'put', 'files' => true]) }}

<div class="row">
	<div class="col-sm-7">
		<div class="form-group">
			<label>{{ trans('dev.Identifier') }}</label>
			<input type="text" class="form-control" name="identifier" value="{{{ $definition->identifier }}}">
			{{ $errors->first('identifier', '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group">
			<label>{{ trans('dev.Tag') }}</label>
			<input class="form-control" name="tag" value="{{{ $definition->tag }}}">
			{{ $errors->first('tag', '<br><div class="alert alert-danger">:message</div>') }}
		</div>
	</div>
</div>
<div class="form-group">
	<label>{{ trans('dev.Description') }}</label>
	<input class="form-control" name="description" value="{{{ $definition->description }}}">
	{{ $errors->first('description', '<br><div class="alert alert-danger">:message</div>') }}
</div>
<div class="checkbox">
	<label>
		{{ Form::checkbox('editable', '1', $definition->editable); }}
		{{ trans('dev.Editable') }}
	</label>
</div>
<div class="checkbox">
	<label>
		{{ Form::checkbox('hidden', '1', $definition->hidden); }}
		{{ trans('dev.Hidden') }}
	</label>
</div>

<hr>
@if ($definition->type == 'string')


<div class="form-group">
	<label>{{ trans('dev.Value') }}</label>
	<input type="text" class="form-control" name="string" value="{{{ $definition->string }}}">
	{{ $errors->first('string', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'code')

<div class="form-group">
	<label>{{ trans('dev.Value') }}</label>
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
	<label>{{ trans('dev.Value') }}</label>
	<textarea class="form-control" name="text">{{{ $definition->text }}}</textarea>
	{{ $errors->first('text', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'integer')

<div class="form-group">
	<label>{{ trans('dev.Value') }}</label>
	<input type="text" class="form-control" name="integer" value="{{ $definition->integer }}">
	{{ $errors->first('integer', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'boolean')

<div class="form-group">
	<label>{{ trans('dev.Value') }}</label>
	<select class="form-control" name="boolean">
		<option value=1 {{ $definition->boolean ? 'selected' : '' }}>Yes</option>
		<option value=0 {{ $definition->boolean ? '' : 'selected' }}>No</option>
	</select>
	{{ $errors->first('boolean', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@elseif ($definition->type == 'image')

<div class="form-group">
	<label>{{ trans('dev.Value') }}</label>
	<div>
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
			<div>
				<span class="btn btn-default btn-file">
					<span class="fileinput-new">{{ trans('dev.Select_Image') }}</span>
					<span class="fileinput-exists">{{ trans('dev.Change') }}</span>
					<input type="file" name="file">
				</span>
				<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{{ trans('dev.Delete') }}</a>
			</div>
		</div>
	</div>
	{{ $errors->first('file', '<br><div class="alert alert-danger">:message</div>') }}
</div>

@endif

<hr>
<div class="pull-right">
	<a class="btn btn-default" href="{{ URL::route('dev.definitions.index') }}">{{ trans('dev.Cancel') }}</a>
	<button class="btn btn-primary">{{ trans('dev.Save') }}</button>
</div>

{{ Form::close() }}
<div class="row">
	<div class="col-sm-12">
		<p>
			{{ trans('dev.Identifier') }}:
			<b>{{ $definition->identifier }}</b>
		</p>
		<p>
			{{ trans('dev.Description') }}:
			<b>{{ $definition->description }}</b>
		</p>
		<p>
			{{ trans('dev.Editable') }}:
			<b>{{ $definition->editable }}</b>
		</p>
		<p>
			{{ trans('dev.Hidden') }}:
			<b>{{ $definition->hidden }}</b>
		</p>
		<p>
			{{ trans('dev.Type') }}:
			<b>{{ trans('dev.'.ucfirst($definition->type)) }}</b>
		</p>
		<hr>
		@if ($definition->type == 'string')

		<p>{{ trans('dev.Value') }}: <b>{{{ $definition->string }}}</b></p>

		@elseif ($definition->type == 'code')

		<p><b>{{ trans('dev.Value') }}:</b></p>
		<div class="clearfix">
			 <textarea class="form-control" name="code" style="display:none">{{{ $definition->code }}}</textarea>
			<div class="editor" id="code"/>
		</div>
		<script>
		    var editor = ace.edit("code");
			var textarea = $('textarea[name="code"]').hide();
			editor.getSession().setValue(textarea.val());
			editor.setReadOnly(true);
			editor.getSession().on('change', function(){
			  textarea.val(editor.getSession().getValue());
			});
		</script>
		<style type="text/css">
		.editor {
			height: 200px;
		}
		</style>

		@elseif ($definition->type == 'text')

		<p><b>{{ trans('dev.Value') }}:</b></p>
		{{{ nl2br($definition->text) }}}

		@elseif ($definition->type == 'integer')

		<p>{{ trans('dev.Value') }}: <b>{{ $definition->integer }}</b></p>

		@elseif ($definition->type == 'boolean')

		<p>{{ trans('dev.Value') }}: <b>{{ $definition->boolean ? 'Yes' : 'No' }}</b></p>

		@elseif ($definition->type == 'image' && $definition->image)

		<div class="row">
			<div class="col-sm-6">
				<img class="img-thumbnail img-responsive" src="{{ asset($definition->image->path) }}">
			</div>
			<div class="col-sm-6">
				<p>{{ $definition->image->path }}</p>
				<div class="">
					<div class="pull-left image-color" style="background-color:{{ $definition->image->key_color }}"></div>
					<div class="pull-left image-color" style="background-color:{{ $definition->image->secondary_color }}"></div>
					<div class="pull-left image-color" style="background-color:{{ $definition->image->background_color }}"></div>
				</div>
				<br>
				<p>{{ $definition->image->width }}x{{ $definition->image->height }}</p>
			</div>
		</div>

		@endif

		<hr>
		<a href="{{ URL::route('dev.definitions.index') }}" class="btn btn-default">{{ trans('dev.Back') }}</a>
		<a href="{{ URL::route('dev.definitions.edit', $definition->id) }}" class="btn btn-default">{{ trans('dev.Edit') }}</a>
		<a href="{{ URL::route('dev.definitions.delete', $definition->id) }}" class="btn btn-danger">{{ trans('dev.Delete') }}</a>
	</div>
</div>

<style>
.image-color {
	width:20px;
	height:20px;
	margin-right: 10px;
	margin-top: -7px;
	border: 1px solid grey;
}
</style>
<div class="row">
	<div class="col-sm-12">
		<span class="label label-{{ !Input::get('tag') ? 'danger' : 'default' }}" style="margin-right: 10px">
			<a href="?" style="color: white">
				{{ trans('dev.All') }}
			</a>
		</span>
		@foreach ($tags as $tag)
			<span class="label label-{{ $tag == Input::get('tag') ? 'danger' : 'default' }}" style="margin-right: 10px">
				<a href="?tag={{ $tag }}" style="color: white">
					{{ $tag }}
				</a>
			</span>
		@endforeach
	</div>
</div>
<hr>

@foreach ($definitions as $index => $definition)
	<div class="row">
		<div class="col-xs-12">
			<div>
				<a class="pull-right btn btn-default btn-xs" href="{{ URL::route('dev.definitions.show', $definition->id) }}">{{ trans('dev.View') }}</a>
				<p >
					@if (!$definition->editable)
						<i class="fa fa-lock" style="margin-right: 5px;"></i>
					@endif
					@if ($definition->hidden)
						<i class="fa fa-eye-slash" style="margin-right: 5px;"></i>
					@endif

					<b>{{ $definition->identifier }}</b> <br>

					<span class="text-muted">{{ $definition->description }}</span><br>

					@if ($definition->type == 'string')
						{{{ $definition->string }}}
					@endif
					@if ($definition->type == 'code')
						<code>{{{ str_limit($definition->code, 100) }}}</code>
					@endif
					@if ($definition->type == 'text')
						{{{ str_limit($definition->text, 100) }}}
					@endif
					@if ($definition->type == 'integer')
						{{{ $definition->integer }}}
					@endif
					@if ($definition->type == 'boolean')
						{{{ $definition->boolean ? 'Yes' : 'No' }}}
					@endif
					@if ($definition->type == 'image_id')
						<img class="img-circle" style="margin-top:10px" src="{{ asset($definition->image->thumbnail_xs) }}">
					@endif
				</p>
				@if ($definition->tag)
					<p>
						<span class="label label-danger" style="margin-right: 10px">
							<a href="?tag={{ $definition->tag }}" style="color: white">
								{{ $definition->tag }}
							</a>
						</span>
					</p>
				@endif
				<hr>
			</div>
		</div>
	</div>

@endforeach

<div class="clearfix">
	{{ $definitions->appends(array('tag' => Input::get('tag') ))->links() }}
</div>


<a class="btn btn-default" href="{{ URL::route('dev.definitions.create') }}">{{ trans('dev.Create') }}</a>
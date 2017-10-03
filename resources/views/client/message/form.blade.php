<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
    {!! Form::label('text', __('client.your_comment')) !!}
    {!! Form::textarea('text', null, ['class' => 'form-control ckeditor']) !!}
    <small class="text-danger">{{ $errors->first('text') }}</small>
</div>


{!! Form::submit(isset($model) ? 'Update' : __('client.create'), ['class'=>'btn btn-primary btn-block' ,'id'=>'submit_response']) !!}


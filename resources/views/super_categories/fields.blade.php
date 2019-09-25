<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-image">
    {!! Form::label('images', 'Image:') !!}
    <input id="images" type="file" name="images[]" class="form-control" multiple>
    {{--    {!! Form::file('images[]', null, ['class' => 'form-control', 'multiple' => true]) !!}--}}
</div>

<!-- Language Field -->
<div class="form-group col-sm-12">
    {!! Form::label('language_id', 'Languages:') !!}
    @foreach(\App\Models\Language::all() as $language)
        <label class="checkbox-inline">
            {!! Form::checkbox('language_id[]', $language->id, isset($superCategory) ? in_array($language->id, $superCategory->languages()->pluck('id')->toArray()) ? $language->id : null : null) !!}  {{ $language->name }}
        </label>
    @endforeach
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('active', 0) !!}
        {!! Form::checkbox('active', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('superCategories.index') !!}" class="btn btn-default">Cancel</a>
</div>

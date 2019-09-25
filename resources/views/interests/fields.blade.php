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
        {!! Form::checkbox('language_id[]', $language->id, isset($interest) ? in_array($language->id, $interest->languages()->pluck('id')->toArray()) ? $language->id : null : null) !!}  {{ $language->name }}
    </label>
    @endforeach
</div>

<!-- Super Category Field -->
<div class="form-group col-sm-12">
    {!! Form::label('super_category_id', 'Super Categories:') !!}
    @foreach(\App\Models\SuperCategory::all() as $superCategory)
        <label class="checkbox-inline">
            {!! Form::checkbox('super_category_id[]', $superCategory->id, isset($interest) ? in_array($superCategory->id, $interest->superCategories()->pluck('id')->toArray()) ? $superCategory->id : null : null) !!}  {{ $superCategory->name }}
        </label>
    @endforeach
</div>


<!-- Active Field -->
<div class="form-group col-sm-12">
    {!! Form::label('active', 'Active:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('active', 0) !!}
        {!! Form::checkbox('active', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('interests.index') !!}" class="btn btn-default">Cancel</a>
</div>

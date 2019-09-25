<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $superCategory->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $superCategory->name !!}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('languages', 'Languages:') !!}
    @foreach($superCategory->languages as $language)
        <p>{!! $language->name !!}</p>
@endforeach
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    <p>{!! $superCategory->active !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $superCategory->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $superCategory->updated_at !!}</p>
</div>


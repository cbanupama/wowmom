<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $interest->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $interest->name !!}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    <p>{!! $interest->active !!}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('languages', 'Languages:') !!}
    @foreach($interest->languages as $language)
         <p>{!! $language->name !!}</p>
    @endforeach
</div>

<!-- Super categories Field -->
<div class="form-group">
    {!! Form::label('super_categories', 'Super categories:') !!}
    @foreach($interest->superCategories as $superCategory)
        <p>{!! $superCategory->name !!}</p>
    @endforeach
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $interest->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $interest->updated_at !!}</p>
</div>


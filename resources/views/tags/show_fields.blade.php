<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $tag->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $tag->name !!}</p>
</div>

<!-- Range Field -->
<div class="form-group">
    {!! Form::label('range', 'Range:') !!}
    <p>{!! $tag->range !!}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('languages', 'Languages:') !!}
    @foreach($tag->languages as $language)
        <p>{!! $language->name !!}</p>
    @endforeach
</div>

<!-- Super categories Field -->
<div class="form-group">
    {!! Form::label('super_categories', 'Super categories:') !!}
    @foreach($tag->superCategories as $superCategory)
        <p>{!! $superCategory->name !!}</p>
    @endforeach
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    <p>{!! $tag->active !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $tag->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $tag->updated_at !!}</p>
</div>


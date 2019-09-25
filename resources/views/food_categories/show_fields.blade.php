<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $foodCategory->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $foodCategory->name !!}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    <p>{!! $foodCategory->active !!}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('languages', 'Languages:') !!}
    @foreach($foodCategory->languages as $language)
        <p>{!! $language->name !!}</p>
    @endforeach
</div>

<!-- Super categories Field -->
<div class="form-group">
    {!! Form::label('super_categories', 'Super categories:') !!}
    @foreach($foodCategory->superCategories as $superCategory)
        <p>{!! $superCategory->name !!}</p>
    @endforeach
</div>

<!-- Tags Field -->
<div class="form-group">
    {!! Form::label('tags', 'Tags:') !!}
    @foreach($foodCategory->tags as $tag)
        <p>{!! $tag->name !!}</p>
    @endforeach
</div>

<!-- Interest Field -->
<div class="form-group">
    {!! Form::label('interests', 'Interests:') !!}
    @foreach($foodCategory->Interests as $interest)
        <p>{!! $interest->name !!}</p>
    @endforeach
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $foodCategory->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $foodCategory->updated_at !!}</p>
</div>


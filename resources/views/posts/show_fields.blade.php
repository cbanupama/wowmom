<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $post->id !!}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{!! $post->type !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $post->title !!}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{!! $post->body !!}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('languages', 'Languages:') !!}
    @foreach($post->languages as $language)
        <p>{!! $language->name !!}</p>
    @endforeach
</div>

<!-- Super categories Field -->
<div class="form-group">
    {!! Form::label('super_categories', 'Super categories:') !!}
    @foreach($post->superCategories as $superCategory)
        <p>{!! $superCategory->name !!}</p>
    @endforeach
</div>

<!-- Interest Field -->
<div class="form-group">
    {!! Form::label('interests', 'Interests:') !!}
    @foreach($post->interests as $interest)
        <p>{!! $interest->name !!}</p>
    @endforeach
</div>

<!-- Tags Field -->
<div class="form-group">
    {!! Form::label('tags', 'Tags:') !!}
    @foreach($post->tags as $tag)
        <p>{!! $tag->name !!}</p>
    @endforeach
</div>

<!-- Food Categories Field -->
<div class="form-group">
    {!! Form::label('food_categories', 'Food Categories:') !!}
    @foreach($post->foodCategories as $foodCategory)
        <p>{!! $foodCategory->name !!}</p>
    @endforeach
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $post->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $post->updated_at !!}</p>
</div>


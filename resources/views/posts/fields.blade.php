<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', [
    'only_image' => 'Only Image',
    'only_video' => 'Only Video',
    'image_and_text' => 'Image And  Text',
    ], null, ['class' => 'form-control', 'placeholder' => 'Please Select Types']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-12" id="form-group-title">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-body">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'post-body']) !!}
</div>

<!-- web link Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-weblink">
    {!! Form::label('web_link', 'Web Link:') !!}
    {!! Form::text('web_link', null, ['class' => 'form-control']) !!}
</div>

<!-- web link Title Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-weblinktitle">
    {!! Form::label('web_link_title', 'Web Link Title:') !!}
    {!! Form::text('web_link_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-image">
    {!! Form::label('images', 'Image:') !!}
    <input id="images" type="file" name="images[]" class="form-control" multiple>
{{--    {!! Form::file('images[]', null, ['class' => 'form-control', 'multiple' => true]) !!}--}}
</div>

<!-- Youtube link Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-youtubelink">
    {!! Form::label('youtube_link', 'Youtube Link:') !!}
    {!! Form::text('youtube_link', null, ['class' => 'form-control']) !!}
</div>

<!--Credit Title Field -->
<div class="form-group col-sm-12" id="form-group-credittitle">
    {!! Form::label('credit_title', 'Credit Title:') !!}
    {!! Form::text('credit_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Credit link Field -->
<div class="form-group col-sm-12 col-lg-12" id="form-group-creditlink">
    {!! Form::label('credit_link', 'Credit Link:') !!}
    {!! Form::text('credit_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Super Category Field -->
<div class="form-group col-sm-12">
        {!! Form::label('super_category_id', 'Super Categories:') !!}
{{--        @foreach(\App\Models\SuperCategory::all() as $superCategory)--}}
                {!! Form::select(
                        'super_category_id[]',
                         \App\Models\SuperCategory::pluck('name', 'id')->toArray(),
                         null,
                         array(
                            'class' => 'form-control',
                            'id' => 'super_category_id',
                            'placeholder' => 'Please Select Super Category'
                         ))
                         !!}

{{--        @endforeach--}}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Languages:') !!}
            {!! Form::select(
                'language_id[]',
                [],
                 null,
                  array(
                    'class' => 'form-control',
                    'id' => 'language_id',
                    'placeholder' => 'Please Select Languages'
                  ))
            !!}
</div>

<!-- Interest Field -->
<div class="form-group col-sm-6">
    {!! Form::label('interest_id', 'Interests:') !!}
        {!! Form::select(
            'interest_id[]',
            [],
              null,
                  array(
                    'class' => 'form-control',
                    'id' => 'interest_id',
                    'placeholder' => 'Please Select Interests'
                  ))
        !!}

</div>

<!-- Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag_id', 'Tags:') !!}
        {!! Form::select(
            'tag_id[]',
             [],
            null,
                array(
                    'class' => 'form-control',
                    'id' => 'tag_id',
                    'placeholder' => 'Please select Tags'
                ))
        !!}
</div>

<!-- Food Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('food_category_id', 'Food Categories:') !!}
    {!! Form::select(
        'food_category_id[]',
         [],
            null,
            array(
                'class' => 'form-control',
                'id' => 'food_category_id',
                'placeholder' => 'Please select Food Category'
            ))
    !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('posts.index') !!}" class="btn btn-default">Cancel</a>
</div>

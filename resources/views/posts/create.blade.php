@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Post
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row" id="post-create">
                    {!! Form::open(['route' => 'posts.store', 'enctype' => 'multipart/form-data']) !!}

                        @include('posts.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            console.log('loaded');
            $('#post-body').summernote();

            $("#super_category_id").on('change', function() {
                var superCategoryId = $('#super_category_id').val();
                var url = '/api/posts/filter-by-super-category/' + superCategoryId;

                $.ajax({
                    type: "GET",
                    url: url,
                    cache: false,
                    success: function(data){

                        // interest
                        var interests = $("#interest_id");
                        interests.find('option').remove();
                        $(data['interests']).each(function(i, v){
                            interests.append($("<option>", { value: v['id'], html: v['name'] }));
                        });

                        // language
                        var languages = $("#language_id");
                        languages.find('option').remove();
                        $(data['languages']).each(function(i, v){
                            languages.append($("<option>", { value: v['id'], html: v['name'] }));
                        });

                        //tags
                        var tags = $("#tag_id");
                        tags.find('option').remove();
                        $(data['tags']).each(function(i, v){
                            tags.append($("<option>", { value: v['id'], html: v['name'] }));
                        });

                        //food Categories
                        var foodCategories = $("#food_category_id");
                        foodCategories.find('option').remove();
                        $(data['food_categories']).each(function(i, v){
                            foodCategories.append($("<option>", { value: v['id'], html: v['name'] }));
                        });
                    }
                });
            });

            $('#type').on('change', function () {
                var selectedValue = $('#type').val();

                if (selectedValue === 'only_image') {
                    $('#form-group-title').hide();
                    $('#form-group-body').hide();
                    $('#form-group-youtubelink').hide();
                }

                if (selectedValue === 'only_video') {
                    $('#form-group-title').show();
                    $('#form-group-body').show();
                    $('#form-group-youtubelink').show();
                    $('#form-group-image').hide();
                }

                if (selectedValue === 'image_and_text') {
                    $('#form-group-title').show();
                    $('#form-group-body').show();
                    $('#form-group-image').show();
                    $('#form-group-youtubelink').hide();
                }
            });
        });
    </script>
@endsection

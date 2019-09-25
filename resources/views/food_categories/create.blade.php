@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Food Category
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'foodCategories.store', 'enctype' => 'multipart/form-data']) !!}

                        @include('food_categories.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

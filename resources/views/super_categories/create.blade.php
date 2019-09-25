@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Super Category
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'superCategories.store', 'enctype' => 'multipart/form-data']) !!}

                        @include('super_categories.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

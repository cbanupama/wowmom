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
                   {!! Form::model($superCategory, ['route' => ['superCategories.update', $superCategory->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

                        @include('super_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
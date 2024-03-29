@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Interest
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($interest, ['route' => ['interests.update', $interest->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

                        @include('interests.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
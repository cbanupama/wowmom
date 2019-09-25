<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

{{--<!-- User Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('name', 'Name:') !!}--}}
{{--    {!! Form::text('name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Date Of Birth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_of_birth', 'Date Of Birth:') !!}
    {!! Form::date('date_of_birth', null, ['class' => 'form-control','id'=>'date_of_birth']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#date_of_birth').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- kid Date Of Birth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kid_date_of_birth', 'Kid Date Of Birth:') !!}
    {!! Form::date('kid_date_of_birth', null, ['class' => 'form-control','id'=>'kid_date_of_birth']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#kid_date_of_birth').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Due Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('due_date', 'Due Date:') !!}
    {!! Form::date('due_date', null, ['class' => 'form-control','id'=>'due_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#due_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Last Period Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_period_date', 'Last Period Date:') !!}
    {!! Form::date('last_period_date', null, ['class' => 'form-control','id'=>'last_period_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#last_period_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::text('photo', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('profiles.index') !!}" class="btn btn-default">Cancel</a>
</div>

<div class="table-responsive">
    <table class="table" id="profiles-table">
        <thead>
            <tr>
                <th>User Id</th>
                <th>Date Of Birth</th>
                <th>Due Date</th>
                <th>Last Period Date</th>
                <th>Phone</th>
                <th>Photo</th>
                <th>Gender</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
                <td>{!! $profile->user_id !!}</td>
                <td>{!! $profile->date_of_birth !!}</td>
                <td>{!! $profile->due_date !!}</td>
                <td>{!! $profile->last_period_date !!}</td>
                <td>{!! $profile->phone !!}</td>
                <td>{!! $profile->photo !!}</td>
                <td>{!! $profile->gender !!}</td>
                <td>
                    {!! Form::open(['route' => ['profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('profiles.show', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('profiles.edit', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

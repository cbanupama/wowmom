<div class="table-responsive">
    <table class="table" id="interests-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Active</th>
                <th>Languages</th>
                <th>Images</th>
                <th>Super categories</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($interests as $interest)
            <tr>
                <td>{!! $interest->name !!}</td>
                <td>{!! $interest->active !!}</td>
                <td>
                    @foreach($interest->languages as $language)
                        <span class="border-info bg-info">{{ $language->name }}</span>
                        @endforeach
                </td>
                <td>
                    @foreach($interest->Images as $image)
                        <img src="{{ $image->path }}" height="25" alt="{{ $image->type }}">
                    @endforeach
                </td>
                <td>
                    @foreach($interest->superCategories as $superCategory)
                        <span class="border-info bg-info">{{ $superCategory->name }}</span>
                    @endforeach
                </td>
                <td>
                    {!! Form::open(['route' => ['interests.destroy', $interest->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('interests.show', [$interest->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('interests.edit', [$interest->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

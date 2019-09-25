<div class="table-responsive">
    <table class="table" id="superCategories-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Language</th>
                <th>Images</th>
                <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($superCategories as $superCategory)
            <tr>
                <td>{!! $superCategory->name !!}</td>
                <td>
                    @foreach($superCategory->languages as $language)
                        <span class="border-info bg-info">{{ $language->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($superCategory->images as $image)
                        <img src="{{ $image->path }}" height="25" alt="{{ $image->type }}">
                    @endforeach
                </td>

                <td>{!! $superCategory->active !!}</td>
                <td>
                    {!! Form::open(['route' => ['superCategories.destroy', $superCategory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superCategories.show', [$superCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superCategories.edit', [$superCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table" id="tags-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Range</th>
                <th>Languages</th>
                <th>Super categories</th>
        <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{!! $tag->name !!}</td>
            <td>{!! $tag->range !!}</td>
                <td>
                    @foreach($tag->languages as $language)
                        <span class="border-info bg-info">{{ $language->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($tag->superCategories as $superCategory)
                        <span class="border-info bg-info">{{ $superCategory->name }}</span>
                    @endforeach
                </td>
            <td>{!! $tag->active !!}</td>
                <td>
                    {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tags.show', [$tag->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tags.edit', [$tag->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

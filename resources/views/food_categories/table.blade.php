<div class="table-responsive">
    <table class="table" id="foodCategories-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Active</th>
                <th>Images</th>
                <th>Languages</th>
                <th>Super categories</th>
                <th>Interests</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($foodCategories as $foodCategory)
            <tr>
                <td>{!! $foodCategory->name !!}</td>
                <td>{!! $foodCategory->active !!}</td>
                <td>
                    @foreach($foodCategory->images as $image)
                      <img src="{{ $image->path }}" height="25" alt="{{ $image->type }}">
                    @endforeach
                </td>
                <td>
                    @foreach($foodCategory->languages as $language)
                        <span class="border-info bg-info">{{ $language->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($foodCategory->superCategories as $superCategory)
                        <span class="border-info bg-info">{{ $superCategory->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($foodCategory->Interests as $interest)
                        <span class="border-info bg-info">{{ $interest->name }}</span>
                    @endforeach
                </td>
                <td>
                    {!! Form::open(['route' => ['foodCategories.destroy', $foodCategory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('foodCategories.show', [$foodCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('foodCategories.edit', [$foodCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

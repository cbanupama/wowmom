<div class="table-responsive">
    <table class="table" id="posts-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Title</th>
                <th>Body</th>
                <th>Languages</th>
                <th>Super categories</th>
                <th>Tags</th>
                <th>Food categories</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{!! $post->type !!}</td>
                <td>{!! $post->title !!}</td>
                <td>{!! $post->body !!}</td>
                <td>
                    @foreach($post->languages as $language)
                        <span class="border-info bg-info">{{ $language->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($post->superCategories as $superCategory)
                        <span class="border-info bg-info">{{ $superCategory->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($post->Tags as $tag)
                        <span class="border-info bg-info">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($post->foodCategories as $foodCategory)
                        <span class="border-info bg-info">{{ $foodCategory->name }}</span>
                    @endforeach
                </td>
                <td>
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('posts.show', [$post->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('posts.edit', [$post->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

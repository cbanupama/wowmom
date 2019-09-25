<li class="{{ Request::is('languages*') ? 'active' : '' }}">
    <a href="{!! route('languages.index') !!}"><i class="fa fa-language"></i><span>Languages</span></a>
</li>

<li class="{{ Request::is('superCategories*') ? 'active' : '' }}">
    <a href="{!! route('superCategories.index') !!}"><i class="fa fa-female"></i><span>Super Categories</span></a>
</li>

<li class="{{ Request::is('interests*') ? 'active' : '' }}">
    <a href="{!! route('interests.index') !!}"><i class="fa fa-shopping-cart"></i><span>Interests</span></a>
</li>

<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

<li class="{{ Request::is('foodCategories*') ? 'active' : '' }}">
    <a href="{!! route('foodCategories.index') !!}"><i class="fa fa-edit"></i><span>Food Categories</span></a>
</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}"><i class="fa fa-envelope"></i><span>Posts</span></a>
</li>

{{--<li class="{{ Request::is('profiles*') ? 'active' : '' }}">--}}
{{--    <a href="{!! route('profiles.index') !!}"><i class="fa fa-edit"></i><span>Profiles</span></a>--}}
{{--</li>--}}
@extends("layouts\mainlayout")

@section("title")
Posts
@endsection

@section("content")
<div class="section">
    <div class="searchbar-wrapper">
        @include("searchbar")
    </div>
    <div>
        @foreach ($posts_summary as $post)
        <a href={{"/post/" . strval($post["id"])}} class="post_summary section tile">

            <div>{{$post["postname"]}}</div>
            @if (!empty($post["created_at"]))
            <div>created at {{$post["created_at"]}}</div>
            @endif
            @if (!empty($post["updated_at"]))
            <div>updated at {{$post["updated_at"]}}</div>
            @endif
            <div class="posts_tags">
                <span>
                    @if (!empty($post["tags"]))
                    tags:
                    @foreach ($post["tags"] as $tag)
                    {{$tag}} 
                    @endforeach
                    @endif
                </span>
            </div>
        </a>
        @endforeach
    </div>

</div>

@endsection
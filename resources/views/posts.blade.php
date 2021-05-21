@extends("layouts\mainlayout")

@section("title")
    Posts
@endsection

@section("content")
<div class="section">

    @foreach ($posts_summary as $post)
        <a href={{"/post/" . strval($post["id"])}} class="post_summary section tile">
            <div>{{$post["postname"]}}</div>
            <div>created at {{$post["created_at"]}}</div>
            @if (!empty($post["updated_at"]))
                <div>updated at {{$post["updated_at"]}}</div>
            @endif 
            <div class="posts_tags">
                @foreach ($post["tags"] as $tag)
                    <a href="#">{{$tag["tagname"]}}</a>
                @endforeach
            </div>
        </a>
    @endforeach
</div>

@endsection


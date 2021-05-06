@extends("layouts\mainlayout")

@section("title")
    posts
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
        </a>
    @endforeach
</div>

@endsection


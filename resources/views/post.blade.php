@extends("layouts\mainlayout")

@section("title")
{{$post["postname"]}}
@endsection

@section("content")
<div class="post-section">
    <div id="toc">
        <div>
            <div>{{$post["postname"]}}</div>
            @if (!empty($post["created_at"]))
            <div>created at {{$post["created_at"]}}</div>
            @endif

            @if (!empty($post["updated_at"]))
            <div>updated at {{$post["updated_at"]}}</div>
            @endif
        </div>
    </div>
    <div class="placeholder none-style"></div>
    <div class="post">

        <div class="markdown-wrapper">
            <div class="markdown-body">
                {!!$markdown!!}
            </div>
        </div>
    </div>

</div>

@endsection
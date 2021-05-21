@extends("layouts\mainlayout")

@section("title")
{{$post_summary["postname"]}}
@endsection

@section("content")
<div class="post-section">
    <div id="toc">
        <div>
            <div>{{$post_summary["postname"]}}</div>
            @if (!empty($post_summary["created_at"]))
            <div>created at {{$post_summary["created_at"]}}</div>
            @endif

            @if (!empty($post_summary["updated_at"]))
            <div>updated at {{$post_summary["updated_at"]}}</div>
            @endif
        </div>
    </div>
    <div class="post">

        <div class="markdown-wrapper">
            <div class="markdown-body">
                {!!$markdown!!}
            </div>
        </div>
    </div>

</div>

@endsection
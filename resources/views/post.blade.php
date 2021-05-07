@extends("layouts\mainlayout")

@section("title")
    $post["postname"]
@endsection

@section("content")
<div class="section">
    <div href={{"post/" . strval($post["id"])}} class="post section tile">
        <div>{{$post["postname"]}}</div>
        <div>created at {{$post["created_at"]}}</div>
        @if (!empty($post["updated_at"]))
            <div>updated at {{$post["updated_at"]}}</div>
        @endif
        <div class="post-body">
        {!!$markdown!!}
        </div>
    </div>
</div>

@endsection


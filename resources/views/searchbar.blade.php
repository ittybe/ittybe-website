<!-- <div class="card my-4">
    <h5 class="card-header">Search</h5>
    <form class="card-body" action="/search" method="GET" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." name="q">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
            </span>
        </div>
    </form>
</div> -->

<div class="searchbar">
    <form action="/search" method="GET" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <div>
                <input type="text" class="form-control" placeholder="search" name="q" >
            </div>
            <div class="btn-wrapper">
                <button class="btn" type="submit" name="action" value="bytags" >search by tags</button>
            </div>
            <div class="btn-wrapper">
                <button class="btn" type="submit" name="action" value="byname" >search by name</button>
            </div>
        </div>
    </form>
</div>
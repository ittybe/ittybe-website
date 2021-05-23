<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostsTags;
use App\Models\Tag;

class PostController extends Controller
{
    private function get_post_summary($id){
        $post = Post::find($id);

        // get poststags of our post
        $poststags = DB::table("posts_tags")->where("postid", $post["id"])->get();

        // get list of tags (string) in poststags
        $tags = [];
        foreach ($poststags as $poststag) {
            $tagid = $poststag->tagid;
            $tagname = Tag::find($tagid)["tagname"];
            // save in list
            array_push($tags, $tagname);                    
        }

        $post_summary = [
            "id" => $post["id"],
            "postname" => $post["postname"], 
            "created_at" => $post["created_at"], 
            "updated_at" => $post["updated_at"],
            "tags" => $tags
        ];
        return $post_summary;
    }

    private function get_posts_summary_all(){
        $posts = Post::all();
        $postsids= [];
        foreach ($posts as $post) {
            array_push($postsids, $post["id"]);
        }
        return $this->get_posts_summary($postsids);
    }

    private function get_posts_summary($ids){
        $posts = [];
        foreach ($ids as $id) {
            array_push($posts, Post::find($id));
        }
        $posts_summary = [];
        foreach ($posts as $post) {
            if ($post["published"]){
                $post_summary = $this->get_post_summary($post["id"]);
                array_push($posts_summary, $post_summary);
            }
            
        }
        return $posts_summary;
    }

    public function search(Request $request){
        // get query in string format  
        $query = trim($request->get("q"));
        $action = trim($request->get("action"));

        $posts_summary = [];
        if (!empty($query)){
            switch ($action) {
                case 'bytags':
                    $posts_summary = $this->search_by_tags($query);
                    break;
                case 'byname':
                    $posts_summary = $this->search_by_name($query);
                    break;
            }
        }        
        return view("posts", compact("posts_summary"));
    }
    
    private function search_by_tags($q){
        // split by spaces 
        $tags = explode(" ", $q);
        
        $postsids = [];

        // foreach in list of query  
        foreach ($tags as $tag) {
            
            // find tag by tagname and get its id 
            $tagid = DB::table("tags")->where("tagname", "=", $tag)->first();
            if (empty($tagid)){
                break;
            }
            else {
                $tagid = $tagid->id;
            }
            // find and save all poststags
            $poststags = DB::table("posts_tags")->where("tagid", "=", $tagid)->get();
            

            // buffer for posts (we multiply sets and get what we need)
            $bufferpostsids = [];
            // get post id from poststags and save id
            foreach ($poststags as $posttag) {
                $postid = $posttag->postid;

                array_push($bufferpostsids, $postid);
            }

            if(empty($postsids)){
                // we dont need to intersect array because it is first try
                $postsids = $bufferpostsids;
            }
            else {
                // but then we have other posts that may have not tags that we looking for
                // that s why we intersect those
                $postsids = array_intersect($postsids, $bufferpostsids);
            }
        }

        // eliminate all copies
        array_unique($postsids);

        // call get_posts_summary($ids) and give it saved ids 
        return $this->get_posts_summary($postsids);
    }   

    private function search_by_name($q){
        // find something like q 
        $posts = DB::table("posts")->where("postname", "LIKE","%{$q}%")->get();
        // get ids 
        $postsids = [] ;
        foreach ($posts as $post) {
            array_push($postsids, $post->id);
        }
        // throw it to function 
        // and return 
        return $this->get_posts_summary($postsids);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $posts_summary = [];
        foreach ($posts as $post) {
            if ($post["published"]){
                $post_summary = $this->get_post_summary($post["id"]);
                array_push($posts_summary, $post_summary);
            }
            
        }
        return view("posts", compact("posts_summary"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!empty($post)) 
        {
            // check for published
            if(!$post["published"]){
                abort(404);
            }

            // get longtext markdown
            $markdown = $post["markdown"];
            
            // convert it to html
            $markdown = Markdown::convertToHtml($markdown);

            $post_summary = $this->get_post_summary($post["id"]);
            // youtube link have to be converted as video on webpage
            // later

            // give it markdown (html format) to view and return
            return view ("post", compact('post_summary', 'markdown'));
        }
        else
        {
            abort(404);
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

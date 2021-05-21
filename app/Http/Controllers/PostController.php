<?php

namespace App\Http\Controllers;

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
        $poststags = PostsTags::where("postid", $post["id"]);
                
        // get list of tags (string) in poststags
        $tags = [];
        foreach ($poststags as $poststag) {
            $tagid = $poststag["tagid"];
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

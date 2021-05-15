<?php

namespace App\Http\Controllers;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
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
                $post_summary = [
                    "id" => $post["id"],
                    "postname" => $post["postname"], 
                    "created_at" => $post["created_at"], 
                    "updated_at" => $post["updated_at"]];
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
            
            // youtube link have to be converted as video on webpage
            // later

            // give it markdown (html format) to view and return
            return view ("post", compact('post', 'markdown'));
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

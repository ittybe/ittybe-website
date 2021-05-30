<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostsTags;
use App\Models\Tag;

class SearchController extends Controller
{
    public function autocomplete_suggestions(){
        // suggestions for autocomplete search 
        // get all posts
        // take names and id of it 
        // select all poststags with id 
        // get all tags ids 
        // select names of tags 
        // concat all names in one long string separeted with spaces 
        return '[{
            "postname" : "something",
            "tags" : "something else something"
        }]';
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class Posts extends Controller
{
    public function show($slug){

        $post = null;

        if(app()->getLocale() == config('app.fallback_locale'))
        {
            $item = Post::where('slug', $slug)->first();
        } else {
            $fallback = config('app.fallback_locale');
            $item = Post::whereHas('translations', function($q) use ($slug, $fallback){
                $q->where('column_name', 'slug');
                $q->where('value', $slug);
                $q->where('locale', app()->getLocale());
            })->first();
        }


        $post = $item->translate(app()->getLocale(), 'en');

        if($slug == $post->slug){
            return view('theme::post', compact('post', 'item'));
        }

        abort(404);

    }

}

<?php namespace App\Utilities\Helper;


use TCG\Voyager\Models\Post;
use TCG\Voyager\Traits\Translatable;

class Helper {

    use Translatable;

    public function getLocalizedSlug($locale, $slug, $fallback = true)
    {
        $post = Post::where('slug', $slug)->first();
        $slug = $post->getTranslatedAttribute('slug', $locale, $fallback);

        return $slug;
    }

}
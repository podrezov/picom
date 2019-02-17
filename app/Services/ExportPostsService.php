<?php namespace App\Services;

use Spatie\ArrayToXml\ArrayToXml;

class ExportPostsService
{
    public function xml($posts)
    {
        $convertedPosts = [];
        foreach ($posts->toArray() as $post) {
            $convertedPosts['post_' . $post['id']] = $post;
        }

        return ArrayToXml::convert($convertedPosts, 'posts');
    }
}

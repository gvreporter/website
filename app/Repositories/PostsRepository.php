<?php
namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository for all posts
 *
 * Use this repository to interact with posts in the DB
 *
*/
class PostsRepository {

    /**
     * Fetch the latest posts
     *
     * @param int $count
     *
     * @return \App\Models\Post
    */
    public function latest(int $count = 20): Collection
    {
        return Post::limit($count)->orderByDesc('created_at')->get();
    }

    /**
     * Store new post
     *
     * @param string $title
     * @param string $coverUrl
     * @param string $content
     * @param \App\Models\User $author
     *
     * @return \App\Models\Post
    */
    public function store(string $title, string $coverUrl, string $content, User $author): Post
    {
        $post = new Post;
        $post->title = $title;
        $post->cover_url = $coverUrl;
        $post->slug = Str::slug($title);
        $post->user_id = $author->id;
        $post->save();

        Storage::disk('posts')->put($post->id . '.md', $content);

        return $post;
    }

    /**
     * Find a post by slug
     *
     * @param string $slug
     * @param bool $countView
     *
     * @return \App\Models\Post
    */
    public function findBySlug(string $slug, bool $countView = false): ?Post
    {
        $post = Post::where('slug', $slug)->first();

        if($post && $countView) {
            $post->views++;
            $post->save();
        }

        return $post;
    }

    /**
     * Delete a post
     *
     * @param string $slug
     *
     * @return bool
    */
    public function remove(string $slug)
    {
        $post = $this->findBySlug($slug);
        $post->delete();
        return true;
    }

    /**
     * Find a post by id
     *
     * @param int $id
     * @param bool $countView
     *
     * @return \App\Models\Post
    */
    public function findById(int $id, bool $countView = false): ?Post
    {
        $post = Post::where('id', $id)->first();

        if($post && $countView) {
            $post->views++;
            $post->save();
        }

        return $post;
    }
}

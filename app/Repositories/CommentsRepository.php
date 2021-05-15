<?php
namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CommentsRepository {
    /**
     * @var \App\Repositories\PostsRepository
    */
    protected $posts;

    public function __construct(PostsRepository $posts) {
        $this->posts = $posts;
    }

    /**
     * Comment a given post
     *
     * @param \App\Models\Post $post The post to comment on
     * @param string $text The contents of the comment
     * @param \App\Models\User $author The author of the comment
     *
     * @return \App\Models\Comment
    */
    public function commentPost(Post $post, string $text, User $author): Comment
    {
        $comment = new Comment;
        $comment->author_id = $author->id;
        $comment->content = $text;
        $comment->post_id = $post->id;
        $comment->save();

        return $comment;
    }

    /**
     * Fetch the comment of a given post
     *
     * @param \App\Models\Post $post
     *
     * @return Illuminate\Database\Eloquent\Collection
    */
    public function postComments(Post $post): Collection
    {
        return Comment::where('post_id', $post->id)->get();
    }
}

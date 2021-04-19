<?php 

namespace Task\Model;

class Posts
{
    /**
     * Storing the post into variable
     */
    private $postList = [];

    /**
     * Set the post
     */
    public function setPosts(array $posts): void
    {
        $this->postList = $posts;
    }

    /**
     *  Get the posts
     */
    public function getPosts(): array
    {
        return $this->postList;
    }

    /**
     * 
     */
    public function addPost(Post $post): void
    {
        $this->postList[] = $post;
    }

    /**
     * 
     */
    public function count(): int
    {
        return count($this->postList);
    }
}
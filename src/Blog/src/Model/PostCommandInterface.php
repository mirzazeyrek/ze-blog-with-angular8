<?php

declare(strict_types=1);

namespace Blog\Model;

use Blog\Entity\Post;

interface PostCommandInterface
{

    /**
     * Persist a new post in the system.
     *
     * @param Post $post
     *            The post to insert; may or may not have an identifier.
     * @return Post The inserted post, with identifier.
     */
    public function insertPost(Post $post): Post;
/**
     * Update an existing post in the system.
     *
     * @param Post $post
     *            The post to update; must have an identifier.
     * @return Post The updated post.
     */
    public function updatePost(Post $post): Post;
/**
     * Delete a post from the system.
     *
     * @param Post $post
     *            The post to delete.
     * @return bool
     */
    public function deletePost(Post $post): bool;
}

<?php

declare(strict_types=1);

namespace Blog\Model;

use Blog\Entity\Post;
use DomainException;

class PostRepository implements PostRepositoryInterface
{

    private $data = [
        1 => [
            'id' => 1,
            'title' => 'Hello World #1',
            'text' => 'This is our first blog post!'
        ],
        2 => [
            'id' => 2,
            'title' => 'Hello World #2',
            'text' => 'This is our second blog post!'
        ],
        3 => [
            'id' => 3,
            'title' => 'Hello World #3',
            'text' => 'This is our third blog post!'
        ],
        4 => [
            'id' => 4,
            'title' => 'Hello World #4',
            'text' => 'This is our fourth blog post!'
        ],
        5 => [
            'id' => 5,
            'title' => 'Hello World #5',
            'text' => 'This is our fifth blog post!'
        ]
    ];

    /**
     * Return a single blog post.
     *
     * @param int $id
     *            Identifier of the post to return.
     * @return Post
     */
    public function findPost($id): Post
    {
        if (! isset($this->data[$id])) {
            throw new DomainException(sprintf('Blog by id "%s" not found', $id));
        }

        return new Post($this->data[$id]);
    }

    /**
     * Return a set of all blog posts that we can iterate over.
     *
     * @return Post[]
     */
    public function findAllPosts(): array
    {
        return array_map(function ($post) {

            return new Post($post);
        }, $this->data);
    }
}

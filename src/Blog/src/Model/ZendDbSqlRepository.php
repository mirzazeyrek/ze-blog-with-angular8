<?php
declare(strict_types = 1);
namespace Blog\Model;

use Blog\Entity\Post;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use InvalidArgumentException;
use RuntimeException;

class ZendDbSqlRepository implements PostRepositoryInterface
{

    /**
     *
     * @var AdapterInterface
     */
    private $db;

    /**
     *
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     *
     * @var Post
     */
    private $postPrototype;

    /**
     * Constructor
     *
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Post $postPrototype
     */
    public function __construct(AdapterInterface $db, HydratorInterface $hydrator, Post $postPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->postPrototype = $postPrototype;
    }

    /**
     * Return a single blog post.
     *
     * @param int $id
     *            Identifier of the post to return.
     * @return Post
     */
    public function findPost($id): Post
    {
        $sql = new Sql($this->db);
        $select = $sql->select('posts');
        $select->where([
            'id = ?' => $id
        ]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf('Failed retrieving blog post with identifier "%s"; unknown database error.', $id));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
        $resultSet->initialize($result);
        $post = $resultSet->current();

        if (! $post) {
            throw new InvalidArgumentException(sprintf('src post with identifier "%s" not found.', $id));
        }

        return $post;
    }

    /**
     * Return a set of all blog posts that we can iterate over.
     *
     * Each entry should be a Blog instance.
     *
     * @return Post[]
     */
    public function findAllPosts(): ResultSetInterface
    {
        $sql = new Sql($this->db);
        $select = $sql->select('posts')->order('id desc');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }
        $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }
}

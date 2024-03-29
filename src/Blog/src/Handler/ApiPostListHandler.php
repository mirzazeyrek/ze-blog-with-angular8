<?php

declare(strict_types=1);

namespace Blog\Handler;

use Doctrine\ORM\EntityManager;
use Blog\Entity\Post;
use Blog\Model\PostRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ApiPostListHandler implements RequestHandlerInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $searchTerm = (string) $request->getAttribute('searchTerm') ?? null;
        $postQ = $this->entityManager->getRepository((Post::class))->createQueryBuilder('p');
        $postQ = $postQ->select('p.id', 'p.title')->orderBy('p.id', 'desc');
        if($searchTerm) {
            $postQ = $postQ->andWhere('p.title LIKE :searchTerm OR p.text LIKE :searchTerm');
            $postQ = $postQ->setParameter('searchTerm', '%'.$searchTerm.'%');
        }
        $data['posts'] = $postQ->getQuery()->getResult();
        return new JsonResponse($data);
    }
}

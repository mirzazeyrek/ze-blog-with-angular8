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
        $data['posts'] = $this->entityManager->getRepository((Post::class))->findBy([], ['id' => 'desc']);
        return new JsonResponse($data);
    }
}

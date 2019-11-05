<?php

declare(strict_types=1);

namespace Blog\Handler;

use Blog\Entity\Post;
use Blog\Model\PostRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ApiPostDetailHandler implements RequestHandlerInterface
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
        $id = (int) $request->getAttribute('id') ?? null;
        $post = $this->entityManager->getRepository((Post::class))->find($id);
        $data = [
            'post' => $post
        ];
        return new JsonResponse($data);
    }
}

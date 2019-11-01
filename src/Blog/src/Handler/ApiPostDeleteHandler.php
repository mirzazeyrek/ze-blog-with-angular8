<?php

declare(strict_types=1);

namespace Blog\Handler;

use Blog\Entity\Post;
use Blog\Model\PostCommandInterface;
use Blog\Model\PostRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ApiPostDeleteHandler implements RequestHandlerInterface
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
        $id = (int) $request->getAttribute('id');

        if (! $id) {
            return new JsonResponse(['message' => 'id must be in the payload'], 304);
        }
        try {
            //$post = $this->repository->findPost($id);
            $post = $this->entityManager->getRepository((Post::class))->findOneBy(['id' => $id]);
        } catch (\InvalidArgumentException $ex) {
            return new RedirectResponse('/post');
        }

     //   $this->entityManager->remove($post);
       // $this->entityManager->flush();

        return new EmptyResponse(304);
    }
}

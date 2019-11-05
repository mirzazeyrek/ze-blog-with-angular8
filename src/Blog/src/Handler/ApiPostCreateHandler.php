<?php

declare(strict_types=1);

namespace Blog\Handler;

use Blog\Entity\Post;
use Blog\Model\PostCommandInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\InputFilter\InputFilterInterface;

class ApiPostCreateHandler implements RequestHandlerInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var InputFilterInterface
     */
    private $inputFilter;

    public function __construct(EntityManager $entityManager, InputFilterInterface $inputFilter)
    {
        $this->entityManager = $entityManager;
        $this->inputFilter = $inputFilter;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
       // $post = new Post();
        $status = 403;
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody() ?: [];
            if( (int) $data['id']>0) {
                $post = $this->entityManager->find(Post::class, $data['id']);
            } else {
                $post = new Post();
            }
            $post->exchangeArray($data);
            $this->inputFilter->setData($data);
            $status = 200;
            if ($this->inputFilter->isValid()) {
                try {
                    $this->entityManager->persist($post);
                    $this->entityManager->flush();
                   // return new RedirectResponse($this->urlHelper->generate('post.detail', [], [
                   //     'id' => $post->getId()
                   // ]));
                } catch (\Exception $ex) {
                    // An exception occurred; we may want to log this later and/or
                    // report it to the user. For now, we'll just re-throw.
                    throw $ex;
                }
            }
        }

        $data = [
            'post' => $post,
            'id'   => $post->getId(),
            'errors' => $this->inputFilter->getMessages()
        ];

        return new JsonResponse($data, $status);
    }
}

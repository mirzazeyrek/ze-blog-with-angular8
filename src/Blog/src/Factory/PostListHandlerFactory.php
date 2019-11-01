<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\PostListHandler;
use Blog\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostListHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostListHandler
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        return new PostListHandler($container->get(PostRepositoryInterface::class), $container->get(TemplateRendererInterface::class), $entityManager);
    }
}

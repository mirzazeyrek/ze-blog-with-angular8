<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\PostDeleteHandler;
use Blog\Model\PostCommandInterface;
use Blog\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostDeleteHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostDeleteHandler
    {
        return new PostDeleteHandler($container->get(PostRepositoryInterface::class), $container->get(PostCommandInterface::class), $container->get(TemplateRendererInterface::class));
    }
}

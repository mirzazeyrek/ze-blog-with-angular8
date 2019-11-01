<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\PostDetailHandler;
use Blog\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostDetailHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostDetailHandler
    {
        return new PostDetailHandler($container->get(PostRepositoryInterface::class), $container->get(TemplateRendererInterface::class));
    }
}

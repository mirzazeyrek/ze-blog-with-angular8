<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\PostUpdateHandler;
use Blog\Model\PostCommandInterface;
use Blog\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\InputFilter\InputFilterInterface;

class PostUpdateHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostUpdateHandler
    {
        return new PostUpdateHandler($container->get(PostRepositoryInterface::class), $container->get(PostCommandInterface::class), $container->get(TemplateRendererInterface::class), $container->get(UrlHelper::class), $container->get(InputFilterInterface::class));
    }
}

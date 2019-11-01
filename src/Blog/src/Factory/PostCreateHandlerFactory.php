<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\PostCreateHandler;
use Blog\Model\PostCommandInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\InputFilter\InputFilterInterface;

class PostCreateHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostCreateHandler
    {
        return new PostCreateHandler($container->get(PostCommandInterface::class), $container->get(TemplateRendererInterface::class), $container->get(UrlHelper::class), $container->get(InputFilterInterface::class));
    }
}

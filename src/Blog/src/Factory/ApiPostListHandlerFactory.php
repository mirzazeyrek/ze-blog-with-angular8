<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\ApiPostListHandler;
use Blog\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ApiPostListHandlerFactory
{

    public function __invoke(ContainerInterface $container): ApiPostListHandler
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        return new ApiPostListHandler($entityManager);
    }
}

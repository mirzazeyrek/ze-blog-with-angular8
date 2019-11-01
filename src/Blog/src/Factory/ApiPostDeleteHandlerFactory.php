<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\ApiPostDeleteHandler;
use Blog\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;

class ApiPostDeleteHandlerFactory
{

    public function __invoke(ContainerInterface $container): ApiPostDeleteHandler
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        return new ApiPostDeleteHandler($entityManager);
    }
}

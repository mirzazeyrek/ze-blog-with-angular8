<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Handler\ApiPostCreateHandler;
use Psr\Container\ContainerInterface;
use Zend\InputFilter\InputFilterInterface;

class ApiPostCreateHandlerFactory
{

    public function __invoke(ContainerInterface $container): ApiPostCreateHandler
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        return new ApiPostCreateHandler($entityManager, $container->get(InputFilterInterface::class));
    }
}

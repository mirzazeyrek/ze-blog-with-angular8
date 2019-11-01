<?php

declare(strict_types=1);

namespace Blog\Factory;

use Blog\Entity\Post;
use Blog\Model\ZendDbSqlRepository;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\ReflectionHydrator;

class ZendDbSqlRepositoryFactory
{

    public function __invoke(ContainerInterface $container): ZendDbSqlRepository
    {
        return new ZendDbSqlRepository($container->get(AdapterInterface::class), new ReflectionHydrator(), new Post());
    }
}

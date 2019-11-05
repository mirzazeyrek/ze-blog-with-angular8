<?php

declare(strict_types=1);

namespace Blog;

use ContainerInteropDoctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\InputFilter\InputFilterInterface;
use App;

/**
 * The configuration provider for the Blog module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{

    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'aliases' => [
                // Model\PostRepositoryInterface::class => Model\PostRepository::class,
                // Model\PostCommandInterface::class => Model\PostCommand::class,
                Model\PostRepositoryInterface::class => Model\ZendDbSqlRepository::class,
                Model\PostCommandInterface::class => Model\ZendDbSqlCommand::class,
                InputFilterInterface::class => Filter\PostInputFilter::class
            ],
            'invokables' => [],
            'factories' => [
                EntityManagerInterface::class          => EntityManagerFactory::class,
                Model\PostRepository::class            => InvokableFactory::class,
                Model\PostCommand::class               => InvokableFactory::class,
                Model\ZendDbSqlRepository::class       => Factory\ZendDbSqlRepositoryFactory::class,
                Model\ZendDbSqlCommand::class          => Factory\ZendDbSqlCommandFactory::class,
                Filter\PostInputFilter::class          => InvokableFactory::class,
                App\Handler\HelloHandler::class        => App\Handler\HelloHandlerFactory::class,
                // Api
                Handler\ApiPostListHandler::class => Factory\ApiPostListHandlerFactory::class,
                Handler\ApiPostDeleteHandler::class => Factory\ApiPostDeleteHandlerFactory::class,
                Handler\ApiPostDetailHandler::class => Factory\ApiPostDetailHandlerFactory::class,
                Handler\ApiPostCreateHandler::class => Factory\ApiPostCreateHandlerFactory::class,
                // Default Html
                Handler\PostCreateHandler::class  => Factory\PostCreateHandlerFactory::class,
                Handler\PostDeleteHandler::class  => Factory\PostDeleteHandlerFactory::class,
                Handler\PostDetailHandler::class  => Factory\PostDetailHandlerFactory::class,
                Handler\PostListHandler::class    => Factory\PostListHandlerFactory::class,
                Handler\PostUpdateHandler::class  => Factory\PostUpdateHandlerFactory::class,
            ]
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'post' => [
                    __DIR__ . '/../templates/'
                ]
            ]
        ];
    }
}

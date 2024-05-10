<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Alias;
use Symfony\Component\Routing\Route;

/**
 * LayoutController
 */
class LayoutController extends AbstractController
{
    /**
     * @return Response
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function renderNavbarAction(): Response
    {
        $router = $this->container->get('router');
        $routes = [];

        try {

            $routesId = [];
            /** @var array $routesAliases */
            $routesAliases = $router->getRouteCollection()->getAliases();

            /**
             * @var string $name
             * @var Alias $alias
             */
            foreach ($routesAliases as $name => $alias) {
                $routesId[] = $alias->getId();
            }

            if (count($routesId)) {
                /** @var string $id */
                foreach ($routesId as $id) {
                    /** @var Route $route */
                    $route = $router->getRouteCollection()->get($id);
                    $routes[] =
                        [
                            'path'  => $route->getPath(),
                            'title' => $route->getOption('title')
                        ];
                }
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        }

        return $this->render('components/navbar.html.twig', [
            'routes' => $routes,
        ]);
    }
}

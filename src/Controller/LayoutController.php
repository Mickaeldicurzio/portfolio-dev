<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\NoTitleDefinedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Alias;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Router;

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
     * @throws NoTitleDefinedException
     *
     * Render navbar / called by render_esi in page layout
     */
    public function renderNavbarAction(): Response
    {
        /** @var Router $router */
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

                    if ($route->getOption('title'))  {


                    $routes[] =
                        [
                            'path'  => $route->getPath(),
                            'title' => $route->getOption('title')
                        ];
                    } else  {
                        throw new NoTitleDefinedException($id, $route->getPath());
                    }
                }
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        }

        return $this->render('components/navbar.html.twig', [
            'routes' => $routes,
        ]);
    }
}

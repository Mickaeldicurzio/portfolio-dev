<?php

declare(strict_types=1);
namespace App\Exception;


/**
 * NoTitleDefinedException
 *
 * Exception throw when no title was defined in a route declaration
 * Example : #[Route('/', options: ['title' => 'Home'])]
 *
 */
class NoTitleDefinedException extends \Exception implements PortfolioExceptionInterface
{
    public function __construct(string $routeName, string $routePath)
    {

        $routeNameArray = explode('_', $routeName);
        $reformName = ucfirst($routeNameArray[count($routeNameArray) - 1]);

        parent::__construct(
            message: "No title option has been defined for the route '" . $routeName .  "'. 
            \n You should defined it for example like : #[Route('" . $routePath . "', options: ['title' => '". $reformName ."'])]"
        );
    }
}
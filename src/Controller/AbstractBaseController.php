<?php
// src/Controller/AbstractBaseController.php
namespace App\Controller;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AbstractBaseController  extends AbstractController
{
    /**
     * @return LoggerInterface
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getLogger(): LoggerInterface
    {
            return $this->container->get('monolog.logger.console');
    }

}
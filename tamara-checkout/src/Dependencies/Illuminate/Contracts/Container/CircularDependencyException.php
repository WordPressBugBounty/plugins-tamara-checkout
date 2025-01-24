<?php

namespace Tamara\Wp\Plugin\Dependencies\Illuminate\Contracts\Container;

use Exception;
use Tamara\Wp\Plugin\Dependencies\Psr\Container\ContainerExceptionInterface;

class CircularDependencyException extends Exception implements ContainerExceptionInterface
{
    //
}

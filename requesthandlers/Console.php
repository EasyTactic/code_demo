<?php

class Console extends RequestHandlerFacade {
    public static function request(Array $paths): string
    {
        $handlerParams = $paths[$_SERVER['argv'][1]];
        $methodName = $handlerParams[1];
        $controllerName = $handlerParams[0];
        $methodParams = $handlerParams[2];
        $filledMethods = array();
        foreach ($methodParams as $key => $value) {
            if(isset($_SERVER['argv'][$key + 2])) {
                $filledMethods[$value] = $_SERVER['argv'][$key + 2];
            }
            else {
                print_r('param ' . $value . ' is unset');
                die();
            }
        }
        $controllerObj = new $controllerName(Connection::getRepository());
        return $controllerObj->$methodName($filledMethods);
    }
}
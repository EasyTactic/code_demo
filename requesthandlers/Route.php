<?php

class Route extends RequestHandlerFacade {
    public static function request(Array $paths): string
    {
        $requestMethod = self::routeHandler();
        $handlerParams = $paths[$requestMethod];
        $controllerName = $handlerParams[0];
        $methodName = $handlerParams[1];
        $methodParams = $handlerParams[2];
        $filledMethods = array();
        if($requestMethod) {
            foreach ($methodParams as $value) {
                if(isset($_GET[$value])) {
                    $filledMethods[$value] = $_GET[$value];
                }
                else {
                    print_r('param ' . $value . ' is unset');
                    die();
                }
            }
        }
        $controllerObj = new $controllerName(Connection::getRepository());
        return $controllerObj->$methodName($filledMethods);
    }
    private static function routeHandler(): string {
        $requestData = $_SERVER['REQUEST_URI'];
        $requestData = substr($requestData, 1);
        if(stripos($requestData, '/')) {
            return mb_substr($requestData, 0, stripos($requestData, '/'));
        }
        elseif (strpos($requestData, '?')) {
            return mb_substr($requestData, 0, stripos($requestData, '?'));
        }
        else {
            return $requestData;
        }
    }
}
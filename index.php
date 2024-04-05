<?php

require 'require.php';

$requestHandlers = [
    'show_all' => [UserController::class, 'showAll', []],
    'show' => [UserController::class, 'show', ['id']],
    'delete' => [UserController::class, 'delete', ['id']],
    'save' => [UserController::class, 'save', ['name', 'age']],
];

if(isset($_SERVER['argv'])) {
    print_r(Console::request($requestHandlers));
}
if($_SERVER['REQUEST_URI']) {
    print_r(Route::request($requestHandlers));
}

//тут нет тестов, валидация почти отсутствует, если не ошибаюсь, нет try catch, в некоторых местах есть сомнительные решения. Писал этот код только для себя, не думал, что придется кому-то показывать
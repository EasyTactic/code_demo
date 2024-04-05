<?php

class Connection
{
    public static function getRepository(): RepositoryInterface
    {
        switch (DB_TYPE) {
            case 'json':
                $connection = new JSONConnection(DB_ADDRESS, DB_NAME, DB_LOGIN, DB_PASSWORD);
                return new JSONLowLoadRepository($connection);
            case 'mysql':
                $connection = new MySQLConnection(DB_ADDRESS, DB_NAME, DB_LOGIN, DB_PASSWORD);
                return new MySQLRepository($connection);
            default:
                echo 'Подключение к базе данных указано неверно';
        }
        return new JSONLowLoadRepository(new JSONConnection('users.json')); //нужно переделать, чтобы возвращался пустой объект
    }
}
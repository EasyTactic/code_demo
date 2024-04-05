<?php



interface BDConnectionInterface
{
    public function __construct(string $address, string $DBName, string $login, string $password);

    public function getHandler();

    public function close();

}
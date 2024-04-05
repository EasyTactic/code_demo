<?php

Class UserController {

    public function __construct(private readonly RepositoryInterface $repository)
    {
    }

    public function save(array $params) : string
    {
        $user = new User($params["name"], $params["age"]);
        $saveValue = $this->repository->save($user);
        return $saveValue ? "Добавлен пользователь " . $saveValue : "Пользователь не был добавлен";
    }

    public function showAll(array $params = null) : string
    {
        $users = $this->repository->showAll();
        $usersView = '';
        foreach ($users as $user) {
            $usersView = $usersView . 'Id: ' . $user->id . ', имя: ' . $user->name . ', возраст: ' . $user->age . "\n";
        }
        return $usersView;
    }

    public function delete(array $params) : string
    {
        $deleted = $this->repository->delete($params["id"]);
        return $deleted ? "Пользователь " . $params["id"] . " удален" : "Пользователь " . $params["id"] . " не найден";
    }

    public function show(array $params) : string
    {
        $user = $this->repository->findById($params["id"]);
        return $user ? 'Id: ' . $user->id . ', имя: ' . $user->name . ', возраст: ' . $user->age : "Пользователь не найден";
    }
}
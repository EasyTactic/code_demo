<?php



interface RepositoryInterface
{

    public function __construct(BDConnectionInterface $connection);

    public function save(User $user);

    public function findById($id);

    public function showAll();

    public function delete($id);
}
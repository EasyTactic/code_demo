<?php



Class JSONLowLoadRepository implements RepositoryInterface
{

    private $connection;
    private $handler;
    private $fileAddress;

    public function __construct(BDConnectionInterface $connection) {
        $this->connection = $connection;
        $this->handler = $this->connection->getHandler();
        $this->fileAddress = $this->connection->getAddress();
    }

    private function getUserArray() {
        $usersObj = json_decode(fread($this->handler, filesize($this->fileAddress)));
        return $usersObj->users;
    }

    public function save(User $user)
    {
        $userName = $user->getName();
        $userAge = $user->getAge();

        $fileAddress = $this->connection->getAddress();
        $userArray = $this->getUserArray();
        $lastUser = end($userArray);
        $userId = intval($lastUser->id) + 1;
        $newUser = new stdClass();
        $newUser->id = $userId;
        $newUser->name = $userName;
        $newUser->age = $userAge;
        $userArray[] = $newUser;
        $this->connection->cleanFile();
        $handler = $this->connection->getHandler();
        fwrite($handler, json_encode((["users" => $userArray])));
        return $userId;
    }

    public function findById($id)
    {
        $myUser = 0;
        $userArray = $this->getUserArray();
        foreach ($userArray as $user)
        {
            if($id == $user->id) {
                $myUser = $user;
            }
        }
        $this->connection->close();
        return $myUser;
    }

    public function showAll()
    {

        $userArray = $this->getUserArray();
        $this->connection->close();
        return $userArray;
    }

    public function delete($id)
    {
        $userDelete = 0;
        $userArray = $this->getUserArray();
        $returnUserArray = array();
        foreach ($userArray as $userKey => $user)
        {
            if($user->id == $id) {
                //unset($userArray[$userKey]);
                $userDelete = 1;
            }
            else {
                $returnUserArray[] = $user;
            }
        }
        $this->connection->cleanFile();
        fwrite($this->connection->getHandler(), json_encode((["users" => $returnUserArray])));
        $this->connection->close();
        return $userDelete;
    }
}
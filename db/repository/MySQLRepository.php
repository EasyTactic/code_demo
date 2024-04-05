<?php



Class MySQLRepository implements RepositoryInterface
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

        $query = "SELECT id, name, age FROM users ORDER BY ID";
        $result = $this->handler->query($query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function save(User $user)
    {
        $userName = $user->getName();
        $userAge = $user->getAge();
        $query = "INSERT INTO users (name, age) VALUES ('".$userName."', ".$userAge.")";
        if($this->handler->query($query)){
            $last_id = $this->handler->insert_id;
            $this->handler->close();
            return $last_id;
        } else{
            return 0;
        }
    }

    public function findById($id)
    {
        $query = "SELECT id, name, age FROM users WHERE id = ". $id ." ORDER BY ID";
        $result = $this->handler->query($query);
        $myUser = $result->fetch_array(MYSQLI_ASSOC);
        $this->handler->close();
        return $myUser;
    }

    public function showAll()
    {

        $userArray = $this->getUserArray();
        $this->connection->close();
        return $userArray;
    }

    public function delete($id) : int
    {
        $query = 'DELETE FROM users WHERE id=' . $id;

        if ($this->handler->query($query) === TRUE) {
            $this->connection->close();
            return $id;
        } else {
            $this->connection->close();
            return 0;
        }
    }
}
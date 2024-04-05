<?php



Class MySQLConnection implements BDConnectionInterface
{

    private mysqli $handle;
    public function __construct(
        private readonly string $address,
        private readonly string $DBName,
        private readonly string $login,
        private readonly string $password = ''
    )
    {
        $this->handle = new mysqli($this->address, $this->login, $this->password, $this->DBName);

    }

    public function getHandler():mysqli {
        return $this->handle;
    }

    public function getAddress():string {
        return $this->address;
    }

    public function close()
    {
        $this->handle->close();
    }
}
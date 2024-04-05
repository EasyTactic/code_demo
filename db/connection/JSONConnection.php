<?php



Class JSONConnection implements BDConnectionInterface
{

    private $handle;
    public function __construct(private readonly string $address, string $DBName = null, string $login = null, string $password = null)
    {
        $this->handle = fopen($address, 'r+b');
    }

    public function getHandler() {
        return $this->handle;
    }

    public function getAddress() {
        return $this->address;
    }

    public function cleanFile()
    {
        fclose($this->handle);
        file_put_contents($this->address, '');
        $this->handle = fopen($this->address, 'r+b');
    }

    public function close()
    {
        fclose($this->handle);
    }
}
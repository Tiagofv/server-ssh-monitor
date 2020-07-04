<?php

namespace Tiagofv\ServerSshMonitor;
use phpseclib\Crypt\RSA;
use phpseclib\Net\SSH2;

/**
 * Class ServerSshMonitor
 * @package Tiagofv\ServerSshMonitor
 */
class ServerSshMonitor
{
    // Build your next great package.

    /**
     * @var
     */
    public $user;
    /**
     * @var
     */
    public $host;
    /**
     * @var int
     */
    public $port;
    /**
     * @var RSA
     */
    public $key;
    /**
     * @var SSH2
     */
    public $connection;

    /**
     * ServerSshMonitor constructor.
     * @param string $host IP address
     * @param string $user username
     * @param number int $port
     * @param string $key
     */
    public function __construct($host, $user, $port = 22, $key)
    {
        $this->user = $user;
        $this->host = $host;
        $this->port = $port;

        $newKey = new RSA();
        $newKey->loadKey($key);
        $this->key = $newKey;
        $this->connection = new SSH2($host);
    }


    /**
     * @return bool
     */
    public function initConnection() : bool
    {
        $login = $this->connection->login($this->user, $this->key);
        if(!$login) throw Exception('It wasnt possible to login on the instance. Verify your credentials.');
        return $login;
    }

    /**
     * @return float current cpu average
     */
    public function getCPUAvg() : float
    {
        $cpu = "grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage}'";
        return (float) $this->connection->exec($cpu);
    }

    /**
     * @return float current ram usage
     */
    public function getRAMUsage() : float
    {
        //Will return 2 outputs: IN USE RAM, TOTAL RAM
        $ram = "free --mega | awk '{if(NR == 2){res = ($2-$7)/$2}} END {print res}'";
        $output = $this->connection->exec($ram);
        preg_match('/\d+\.\d+/', $output, $matches);
        if(count($matches) > 0) return $matches[0];
        else return 0;
    }

}

<?php

namespace CodeStop\Proof;

/**
 * Config class for the JS Proof library
 * TODO - We don't need this anymore.
 */

class Config
{
    /** @var String $binPath the binary path of the course */
    private $binPath;

    /** 
     * Constructor - loads the configuration file (proof.json).
     */
    public function __construct()
    {   
        $this->binPath = 'vendor/bin';
    }   

    public function getBinPath()
    {   
        return $this->binPath;
    }   
}
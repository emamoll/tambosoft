<?php

class Env
{
  private $env;

  public function __construct()
  {
    $this->env = parse_ini_file('../../.env');
  }

  public function get($key)
  {
    return $this->env[$key];
  }
}

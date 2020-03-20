<?php

namespace Run\panel\core\route;

class Login {

    protected $login, $param;

    public function __construct($param)
    {
        $this->login = false;
        $this->param = $param;
    }

}

<?php

namespace Run\panel\core\main;

class Main extends View {

    public function __construct($param)
    {
        parent::__construct($this->_param($param));
    }

    private function _param($param)
    {
        $this->lang = 'ru';
        return $param;
    }

}

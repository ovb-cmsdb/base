<?php

namespace Run\panel\core\main;

class Main extends View {

    private $module;

    public function __construct($param)
    {
        parent::__construct($this->_param($param));
    }

    private function _param($param)
    {
        $lang = new \Run\panel\core\corp\Lang;
        $this->lang = $lang->lang;
        $param['multilang'] = $lang->multilang();
        $this->module = explode('/', $param['path'])[0];
        $html = require 'html/main.php';
        $param['personal'] = $this->_personal($html);
        return $param;
    }

    private function _personal($html)
    {
        return $this->module === 'personal' ? (
                $html['personal']
                ) : $html['personal_link'];
    }

}

<?php

namespace Run\panel\core\login;

use Run\panel\core\corp\Path;

class Login extends View {

    public function __construct($param)
    {
        $lang = new \Run\panel\core\corp\Lang;
        $this->lang = $lang->lang;
        $this->multilang = $lang->multilang();
        $this->request = $param['request'];
        $this->mail = $this->_mail();
        $this->_switch(
                $param['login'],
                require 'lang/warning/' . $this->lang . '.php'
        );
        parent::view();
    }

    private function _mail()
    {
        return filter_has_var(0, 'mail') ? trim(filter_input(0, 'mail')) : '';
    }

    private function _switch($login, $lw)
    {
        switch ($login) {
            case 1: $w = $lw['incorrect'];
                break;
            case 2: $w = $lw['blocked'];
                break;
            case 3: $w = $lw['timeout'];
                break;
            case 4: $w = $lw['server'];
                break;
        }
        $this->warning = isset($w) ? (
                str_replace('[W]', $w, require Path::HTML . 'wg.php')
                ) : '';
    }

}

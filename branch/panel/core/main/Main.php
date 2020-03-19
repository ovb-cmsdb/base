<?php

namespace Run\panel\core\main;

use Run\panel\core\corp\Path;

class Main extends View {

    private $module;
    protected $le;

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
        $param['logo'] = $this->_logo($param['path'], $html);
        $param['personal'] = $this->_personal($html);
        return $param + $this->_lang($param['path']);
    }

    private function _logo($path, $html)
    {
        return $path === 'main' ? $html['logo'] : $html['logo_link'];
    }

    private function _personal($html)
    {
        return $this->module === 'personal' ? (
                $html['personal']
                ) : $html['personal_link'];
    }

    private function _lang($path)
    {
        $lang = [];
        $file = Path::MODULE . $path . '/lang/' . $this->lang . '.php';
        if (file_exists($file)) {
            $lf = require $file;
            !isset($lf['lp']) ?: $lang['lp'] = $lf['lp'];
            !isset($lf['le']) ?: $this->le = $lf['le'];
        }
        return $lang;
    }

}

<?php

namespace Run\panel\core\main;

use Run\panel\core\corp\Path;

class Main extends View {

    private $module;
    protected $le;

    public function __construct($param)
    {
        parent::__construct($this->_param($param));
        !isset($param['error']) ?: $this->_error($param['error']);
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
        $file = Path::MODULE . $path . '/lang/' . $this->lang . '.php';
        if (file_exists($file)) {
            $lf = require $file;
            !isset($lf['lp']) ?: $lang['lp'] = $lf['lp'];
            !isset($lf['lm']) ?: $lang['menu'] = $this->_menu($lf['lm']);
            !isset($lf['le']) ?: $this->le = $lf['le'];
        }
        return $lang ?? [];
    }

    private function _menu($lm)
    {
        $blank = [];
        if (isset($lm['blank'])) {
            $blank = $lm['blank'];
            unset($lm['blank']);
        }
        asort($lm);
        reset($lm);
        $list = '';
        $html = require 'html/menu.php';
        foreach ($lm as $k => $v) {
            $list .= str_replace(['[H]', '[A]'], [$k, $v], $html[
                    in_array($k, $blank) ? 'li_blank' : 'li'
            ]);
        }
        return str_replace('[L]', $list, $html['ul']);
    }

    private function _error($code)
    {
        $lang = (require 'lang/error/' . $this->lang . '.php')[$code];
        parent::view([
            'title' => $lang['title'],
            'content' => str_replace(
                    '[E]',
                    $lang['content'],
                    require Path::HTML . 'error.php'
            )
        ]);
    }

}

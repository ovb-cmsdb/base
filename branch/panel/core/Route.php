<?php

namespace Run\panel\core;

class Route extends route\Param {

    private $path;

    public function __construct($param)
    {
        parent::__construct($this->_param($param));
        $this->_404();
    }

    private function _param($param)
    {
        if ($param['path'] === 'logout') {
            header('Location: /');
            exit;
        }
        $this->path = str_replace('/', '\\', $param['path']) . '\\';
        return $param;
    }

    private function _404()
    {
        $this->_404 ? $this->_error(404) : $this->_module();
    }

    private function _error($code)
    {
        http_response_code($code);
        new main\Main($this->param);
    }

    private function _module()
    {
        $module = '\\Run\\panel\\module\\' . $this->path . $this->class;
        new $module($this->param);
    }

}

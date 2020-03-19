<?php

namespace Run\panel\core;

class Route extends route\Param {

    private $path;

    public function __construct($param)
    {
        parent::__construct($this->_param($param));
        $this->_module();
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

    private function _module()
    {
        $module = '\\Run\\panel\\module\\' . $this->path . $this->class;
        new $module($this->param);
    }

}

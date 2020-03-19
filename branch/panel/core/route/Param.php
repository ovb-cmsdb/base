<?php

namespace Run\panel\core\route;

use Run\panel\core\corp\Path;

class Param {

    protected $class, $_404, $param;

    public function __construct($param)
    {
        $class = end(explode('/', $param['path']));
        $this->class = mb_convert_case($class, MB_CASE_TITLE);
        $this->_404 = false;
        $file = Path::MODULE . $param['path'] . '/' . $this->class . '.php';
        if ($param['error'] or ! file_exists($file)) {
            $this->_404 = true;
            $param['error'] = '404';
        } else {
            unset($param['error']);
        }
        $this->param = $param;
    }

}

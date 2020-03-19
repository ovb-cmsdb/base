<?php

namespace Run\panel\core\route;

use Run\panel\core\corp\Path;

class Param {

    protected $class, $param;

    public function __construct($param)
    {
        $class = end(explode('/', $param['path']));
        $this->class = mb_convert_case($class, MB_CASE_TITLE);
        $file = Path::MODULE . $param['path'] . '/' . $this->class . '.php';
        if (file_exists($file)) {
            unset($param['error']);
        }
        $this->param = $param;
    }

}

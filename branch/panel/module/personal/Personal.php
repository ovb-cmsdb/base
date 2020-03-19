<?php

namespace Run\panel\module\personal;

class Personal extends \Run\panel\core\main\Main {

    public function __construct($param)
    {
        parent::__construct($param);
        parent::view([
            'title' => $this->le['title'],
            'route' => $this->le['route'],
            'content' => 'Personal'
        ]);
    }

}

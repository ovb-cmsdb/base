<?php

namespace Run\panel\core\main;

class View {

    private $param;
    protected $lang;

    public function __construct($param)
    {
        $this->param = $param;
    }

    protected function view($param = [])
    {
        $view = $this->_view(require 'lang/' . $this->lang . '.php', $param);
        echo str_replace(
                array_keys($view),
                array_values($view),
                file_get_contents(__DIR__ . '/view.tpl')
        );
    }

    private function _view($lt, $param)
    {
        return[
            '{ LANG }' => $this->lang,
            '{ TITLE:LT }' => $lt['title'],
            '{ SIGN_OUT-UPP:LT }' => $lt['sign_out-upp'],
            '{ CONTENT }' => $param['content'] ?? '',
            '{ EXT }' => $this->param['ext'],
            '{ EOL }' => '        ' . PHP_EOL
        ];
    }

}

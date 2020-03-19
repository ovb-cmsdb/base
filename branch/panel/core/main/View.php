<?php

namespace Run\panel\core\main;

class View {

    private $exp, $param;
    protected $lang;

    public function __construct($param)
    {
        $this->exp = explode('/', $param['path']);
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
            '{ TITLE }' => $this->_title($param['title'] ?? ''),
            '{ LOGO }' => $this->param['logo'],
            '{ SIGN_OUT-UPP:LT }' => $lt['sign_out-upp'],
            '{ MULTILANG }' => $this->param['multilang'],
            '{ PERSONAL }' => $this->param['personal'],
            '{ ROUTE }' => $this->_route($param['route'] ?? ''),
            '{ CONTENT }' => $param['content'] ?? '',
            '{ REQUEST }' => $this->param['request'],
            '{ MENU }' => $this->param['menu'],
            '{ EXT }' => $this->param['ext'],
            '{ EOL }' => '        ' . PHP_EOL
        ];
    }

    private function _title($append)
    {
        $title = '';
        if (isset($this->param['lp']) and ! isset($this->param['error'])) {
            foreach ($this->exp as $v) {
                $title .= ' » ' . $this->param['lp'][$v];
            }
        }
        return $title . (empty($append) ? '' : ' » ' . $append);
    }

    private function _route($append)
    {
        if (isset($this->param['lp']) and ! isset($this->param['error'])) {
            $html = require 'html/route.php';
            $routes = $this->_routes($html);
            empty($append) ?: $routes .= isset($append['red']) ? (
                            str_replace('[T]', $append['red'], $html['red'])
                            ) : (
                            str_replace('[T]', $append, $html['p'])
                            );
            $route = str_replace('[R]', $routes, $html['div']);
        }
        return $route ?? '';
    }

    private function _routes($html)
    {
        $routes = '';
        for ($i = 0, $c = count($this->exp), $path = ''; $i < $c; $i++) {
            if ($i === $c - 1) {
                $routes .= str_replace(
                        '[T]', $this->param['lp'][$this->exp[$i]], $html['p']
                );
                break;
            }
            $path .= '/' . $this->exp[$i];
            $routes .= str_replace(
                    ['[H]', '[A]'],
                    [$path, $this->param['lp'][$this->exp[$i]]],
                    $html['a']);
        }
        return $routes;
    }

}

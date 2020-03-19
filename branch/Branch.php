<?php

namespace Run;

class Branch {

    use traits\Server;

    private $param;

    public function __construct()
    {
        $panel = (new data\install\Settings)->run();
        $this->_parser($this->server_request());
        $this->_branch($panel, $this->param['ext']);
    }

    private function _parser($request)
    {
        $query = strrchr($request, '?');
        $urn = boolval($query) ? (
                substr($request, 0, - strlen($query))
                ) : $request;
        $urnext = strrchr($urn, '.');
        $ext = boolval($urnext) ? $urnext : '';
        $extlen = strlen($ext);
        $path = substr(boolval($urnext) ? substr($urn, 0, - $extlen) : $urn, 1);
        $error = (
                preg_match('/^[\w\-\.\/\?\&\=\:]+$/iu', $request) === 0 or
                preg_match('/\/\//', $request) === 1 or
                preg_match('/[\/]$/', $path) === 1 or
                $ext and empty($path) or
                strlen($ext) === 1
                ) ? true : false;
        $this->_param($error, $request, $path, $ext);
    }

    private function _param($error, $request, $path, $ext)
    {
        $this->param = [
            'error' => $error,
            'request' => $request,
            'path' => $path,
            'ext' => $ext
        ];
    }

    private function _branch($panel, $ext)
    {
        $panel === $ext ? $this->_panel() : $this->_website($panel);
    }

    private function _panel()
    {
        new panel\core\Route($this->param);
    }

    private function _website($panel)
    {
        new website\Route($panel);
    }

}

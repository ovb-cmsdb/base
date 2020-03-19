<?php

namespace Run\traits;

trait Server {

    private function server_request()
    {
        return urldecode($_SERVER['REQUEST_URI']);
    }

    private function server_domain()
    {
        $exp = explode('.', urldecode(filter_var($_SERVER['HTTP_HOST'])));
        $exp[0] !== 'www' ?: array_shift($exp);
        return '.' . implode('.', $exp);
    }

}

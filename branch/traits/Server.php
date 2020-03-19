<?php

namespace Run\traits;

trait Server {

    private function server_request()
    {
        return urldecode($_SERVER['REQUEST_URI']);
    }

}

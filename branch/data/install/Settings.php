<?php

namespace Run\data\install;

use Run\Root;

class Settings {

    public function run()
    {
        file_exists(Root::SZ) ?: $this->_settings();
        $run = unserialize(file_get_contents(Root::SZ . 'branch_run.sz'));
        return $run['panel'];
    }

    private function _settings()
    {
        mkdir(Root::SZ);
        $this->_branch_run();
    }

    private function _branch_run()
    {
        file_put_contents(Root::SZ . 'branch_run.sz', serialize([
            'panel' => '.ww'
        ]));
    }

}

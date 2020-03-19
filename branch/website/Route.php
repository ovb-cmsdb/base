<?php

namespace Run\website;

class Route {

    private $lang;

    public function __construct($panel)
    {
        $this->lang = 'ru';
        $view = $this->_view(require 'lang/' . $this->lang . '.php', $panel);
        echo str_replace(
                array_keys($view),
                array_values($view),
                file_get_contents(__DIR__ . '/view.tpl')
        );
    }

    private function _view($lang, $panel)
    {
        return[
            '{ LANG }' => $this->lang,
            '{ TITLE:LT }' => $lang['title'],
            '{ SIGN_IN-UPP:LT }' => $lang['sign_in-upp'],
            '{ PANEL }' => $panel
        ];
    }

}

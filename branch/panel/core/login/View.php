<?php

namespace Run\panel\core\login;

class View {

    protected $lang, $multilang, $request, $mail, $warning;

    protected function view()
    {
        $view = $this->_view(require 'lang/' . $this->lang . '.php');
        echo str_replace(
                array_keys($view),
                array_values($view),
                file_get_contents(__DIR__ . '/view.tpl')
        );
    }

    private function _view($lt)
    {
        return[
            '{ LANG }' => $this->lang,
            '{ TITLE:LT }' => $lt['title'],
            '{ SIGN_OUT-UPP:LT }' => $lt['sign_out-upp'],
            '{ MULTILANG }' => $this->multilang,
            '{ ROUTE:LT }' => $lt['route'],
            '{ REQUEST }' => $this->request,
            '{ MAIL:LT }' => $lt['mail'],
            '{ MAIL:PH }' => $lt['mail_ph'],
            '{ MAIL }' => $this->mail,
            '{ PASS:LT }' => $lt['pass'],
            '{ PASS:PH }' => $lt['pass_ph'],
            '{ WARNING }' => $this->warning,
            '{ BUTTON }' => $lt['sign_in-upp']
        ];
    }

}

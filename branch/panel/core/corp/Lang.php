<?php

namespace Run\panel\core\corp;

use Run\panel\core\corp\Path;

class Lang {

    use \Run\traits\Server;

    private $langs;
    public $lang;

    public function __construct()
    {
        $this->lang = $this->_lang();
    }

    private function _lang()
    {
        $this->langs = unserialize(file_get_contents(
                        Path::SZ . 'panel_langs.sz'
        ));
        $lang = $this->langs['lang'];
        if ($this->langs['multilang']) {
            return $lang;
        }
        if (filter_has_var(0, 'pl:lang')) {
            $post = filter_input(0, 'pl:lang');
            if (isset($this->langs['langs'][$post])) {
                $this->_cookie($post);
                $lang = $post;
            }
        } elseif (filter_has_var(2, 'pl:lang')) {
            $cookie = filter_input(2, 'pl:lang');
            !isset($this->langs['langs'][$cookie]) ?: $lang = $cookie;
        }
        return $lang;
    }

    private function _cookie($post)
    {
        setcookie(
                'pl:lang',
                $post,
                strtotime('+ 1 year'),
                '/',
                $this->server_domain(),
                true
        );
    }

    public function multilang()
    {
        if ($this->langs['multilang']) {
            return '';
        }
        $html = require Path::HTML . 'lang.php';
        $button = '';
        foreach ($this->langs['langs'] as $k => $v) {
            if ($k !== $this->lang) {
                $button .= str_replace(
                        ['[V]', '[I]', '[B]'], [$k, $k, $v], $html['button']
                );
            }
        }
        return str_replace(
                ['[L]', '[B]'],
                [
                    $this->langs['langs'][$this->lang],
                    $button
                ],
                $html['div']
        );
    }

}

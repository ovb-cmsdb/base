<?php

spl_autoload_register(function($class) {
    require __DIR__ . '/' . str_replace(
                    '\\',
                    '/',
                    explode('\\', $class)[0] === 'Run' ? (
                            'branch/' . substr($class, 4)
                            ) : 'extern/' . $class
            ) . '.php';
}, true);

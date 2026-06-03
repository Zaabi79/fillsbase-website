<?php

add_hook('ClientAreaPageLogin', 1, function($vars) {
    header('Location: /login');
    exit;
});

add_hook('ClientAreaPageRegister', 1, function($vars) {
    header('Location: /register');
    exit;
});

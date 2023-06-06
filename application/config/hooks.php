<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

$hook['post_system'] = [
    'class' => 'LogQueryHook',
    'function' => 'logQueries',
    'filename' => 'LogQueryHook.php',
    'filepath' => 'hooks',
];

$hook['post_controller_constructor'] = [
    'class' => 'LanguageLoader',
    'function' => 'languageSwitch',
    'filename' => 'LanguageLoader.php',
    'filepath' => 'hooks',
];
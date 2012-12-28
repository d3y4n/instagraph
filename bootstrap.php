<?php

error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);

define('ROOT', dirname(realpath(__FILE__)) . '/');

require ROOT . 'lib/Instagraph/Instagraph.php';

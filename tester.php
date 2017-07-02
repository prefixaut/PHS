<?php

require __DIR__ . '/vendor/autoload.php';

$src = new PHS\v1\API();

var_dump($src->games->get('sms'));

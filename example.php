<?php

require('vendor/autoload.php');

use Vinhais\OsascoNfePhpSdk\NFe;
use Vinhais\OsascoNfePhpSdk\Types;

$nfe = new NFe([
	'env' => 'testing', // "testing" ou "prod",
	'key' => 'XXXXXXXXXXXXXXXXX', // sua chave
]);
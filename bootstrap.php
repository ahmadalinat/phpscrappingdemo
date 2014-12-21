<?php
//turn off error reporting
error_reporting(E_ALL);
//set request timeout
set_time_limit(REQUEST_TIMEOUT);

require_once __DIR__ . '/Lib/3rd/Klein/Exceptions/KleinExceptionInterface.php';
require_once __DIR__ . '/Lib/3rd/Klein/Exceptions/HttpExceptionInterface.php';
require_once '/Lib/Infra/Helpers/ErrorHandlerHelper.php';
require_once 'Lib/Infra/Helpers/LoaderHelper.php';


set_error_handler (array('\Lib\Infra\Helpers\ErrorHandlerHelper','handle'));
spl_autoload_register(array('\Lib\Infra\Helpers\LoaderHelper','autoload'));


\Lib\Infra\Helpers\LoaderHelper::include_dir(__DIR__ . '/Lib/3rd/Klein');

//init REST router
$klein = new \Klein\Klein();

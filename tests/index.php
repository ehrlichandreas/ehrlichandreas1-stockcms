<?php

ini_set('display_startup_errors', true);

ini_set('display_errors', true);

ini_set('error_reporting', -1);

error_reporting(-1);

date_default_timezone_set('UTC');

ini_set('log_errors', 1);

ini_set('error_log', dirname(__FILE__) . '/_errorlog/' . date('Y-m-d') . '.php.log');

if (! file_exists(dirname(__FILE__) . '/_errorlog/') || ! is_dir(dirname(__FILE__) . '/_errorlog/'))
{
    mkdir(dirname(__FILE__) . '/_errorlog/', 0777, true);
}

require_once dirname(dirname(__FILE__)) . '/vendor/autoload_52.php';

$dbConfig = array
(
	'adapter'	=> 'Pdo_Mysql',
	'params'	=> array
	(
		'host'		=> 'localhost',
        'port'      => '8889',
		'username'	=> 'root',
		'password'	=> 'root',
		'dbname'	=> 'tests',
		'charset'	=> 'utf8',
	),
);

$dbConnection = EhrlichAndreas_Db_Db::factory($dbConfig);

$stockCmsConfig = array
(
    'db'                => $dbConnection,
    'dbtableprefix'     => '__test',
);

$strockCms = new EhrlichAndreas_StockCms_ModuleExtended($stockCmsConfig);

echo '<pre>';

try
{
    $strockCms->install();
}
catch (Exception $e)
{
    echo $e;
}

$customer_id = '12';

$product_id = array
(
    'product_id' => '18',
);

$product_id = '10';

$count = 4;

$strockCms->addProductToCart($customer_id, $product_id, $count);


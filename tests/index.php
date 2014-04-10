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

$products = array
(
    array
    (
        'product_id'        => '12',
        'price'             => '7.00',
        'product_quantity'  => '5000',
    ),
    array
    (
        'product_id'        => '19',
        'price'             => '13.00',
        'product_quantity'  => '500',
    ),
    array
    (
        'product_id'        => '23',
        'price'             => '18.00',
        'product_quantity'  => '50',
    ),
);

foreach ($products as $product)
{
    #$strockCms->addProductToStock($product);
}

$productsCart = array
(
    array
    (
        'customer_id'   => '7',
        'product_id'    => '12',
        'count'         => '34',
    ),
    array
    (
        'customer_id'   => '7',
        'product_id'    => '19',
        'count'         => '23',
    ),
    array
    (
        'customer_id'   => '7',
        'product_id'    => '23',
        'count'         => '2',
    ),
    array
    (
        'customer_id'   => '9',
        'product_id'    => '19',
        'count'         => '5',
    ),
    array
    (
        'customer_id'   => '3',
        'product_id'    => '12',
        'count'         => '65',
    ),
);

foreach ($productsCart as $productCart)
{
    $customer_id = $productCart['customer_id'];
    
    $product_id = $productCart['product_id'];
    
    $count = $productCart['count'];
    
    $strockCms->addProductToCart($customer_id, $product_id, $count);
}

$customer_id = '7';

$strockCms->createOrderFromCart($customer_id);

die();

$customer_id = '12';

$product_id = array
(
    'product_id' => '18',
);

$product_id = '10';

$count = 4;

$strockCms->addProductToCart($customer_id, $product_id, $count);

sleep(10);

$strockCms->editProductInCart($customer_id, $product_id, $count);

sleep(5);

$strockCms->deleteProductFromCart($customer_id, $product_id);

sleep(5);

$customer_id = '7';

$strockCms->emptyCart($customer_id);


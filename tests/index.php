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
		'dbname'	=> 'cfp',
		'charset'	=> 'utf8',
	),
);

$dbConnection = EhrlichAndreas_Db_Db::factory($dbConfig);

$stockCmsConfig = array
(
    'db'                => $dbConnection,
    //'dbtableprefix'     => '__test',
);

$strockCms = new EhrlichAndreas_StockCms_ModuleExtended($stockCmsConfig);


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
        'extern_id'         => '182',
        'price'             => '7.00',
        'product_quantity'  => '5000',
    ),
    array
    (
        'product_id'        => '19',
        'extern_id'         => '34523',
        'price'             => '13.00',
        'product_quantity'  => '500',
    ),
    array
    (
        'product_id'        => '23',
        'extern_id'         => '433',
        'price'             => '18.00',
        'product_quantity'  => '50',
    ),
);

foreach ($products as $product)
{
    $param = array
    (
        'cols'  => array
        (
            'count' => new EhrlichAndreas_Db_Expr('count(product_id)'),
        ),
        'where' => array
        (
            'extern_id' => $product['extern_id'],
        ),
        'limit' => '1',
    );
    
    if (isset($product['extern_id_type']))
    {
        $param['where']['extern_id_type'] = $product['extern_id_type'];
    }
    
    $rowset = $strockCms->getProduct($param);
    
    if (empty($rowset) || !isset($rowset[0]['count']) || $rowset[0]['count'] == 0)
    {
        $strockCms->addProductToStock($product, true);
    }
}

$productsCart = array
(
    array
    (
        'customer_id'   => '7',
        'extern_id'     => '182',
        'count'         => '34',
    ),
    array
    (
        'customer_id'   => '7',
        'extern_id'     => '34523',
        'count'         => '23',
    ),
    array
    (
        'customer_id'   => '7',
        'extern_id'     => '433',
        'count'         => '2',
    ),
    array
    (
        'customer_id'   => '9',
        'extern_id'     => '34523',
        'count'         => '5',
    ),
    array
    (
        'customer_id'   => '3',
        'extern_id'     => '182',
        'count'         => '65',
    ),
);

foreach ($productsCart as $productCart)
{
    //$strockCms->addProductToCart($productCart);
}

$customer_id = '7';

$strockCms->createOrderFromCart($customer_id);

sleep(10);

$productCart = array
(
    'customer_id'   => '12',
    'extern_id'     => '182',
    'count'         => '4',
);

$strockCms->addProductToCart($productCart);

sleep(10);

$productCart['count'] = 10;

$strockCms->editProductInCart($productCart);

sleep(5);

$strockCms->deleteProductFromCart($productCart);

sleep(5);

$productCart['customer_id'] = 9;

$strockCms->emptyCart($productCart['customer_id']);


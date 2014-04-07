<?php 

/**
 *
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_StockCms_Adapter_Pdo_Mysql extends EhrlichAndreas_AbstractCms_Adapter_Pdo_Mysql
{
    
    /**
     *
     * @var string
     */
    private $tableCart = 'stock_cart';
    
    /**
     *
     * @var string
     */
    private $tableCartProduct = 'stock_cart_product';
    
    /**
     *
     * @var string
     */
    private $tableOrder = 'stock_order';
    
    /**
     *
     * @var string
     */
    private $tableOrderDetail = 'stock_order_detail';
    
    /**
     *
     * @var string
     */
    private $tableOrderReturn = 'stock_order_return';
    
    /**
     *
     * @var string
     */
    private $tableOrderReturnDetail = 'stock_order_return_detail';

    /**
     *
     * @var string
     */
    private $tableProduct = 'stock_product';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableVersion = 'stock_version';
	
    /**
     * 
     * @return \EhrlichAndreas_KeyvalueCms_Adapter_Pdo_Mysql
     */
	public function install ()
    {
        $this->_install_version_10000();
        
        return $this;
    }
	
	/**
	 * 
	 * @return GoldAg_LottoCms_Adapter_Pdo_Mysql
	 */
	protected function _install_version_10000 ()
	{
		$version = '10000';
		
		$dbAdapter = $this->getConnection();
        
        $tableVersion = $this->getTableName($this->tableVersion);
		
		$versionDb = $this->_getVersion($dbAdapter, $tableVersion);
		
		if ($versionDb >= $version)
		{
			return $this;
		}
		
        $tableCart = $this->getTableName($this->tableCart);
		
        $tableCartProduct = $this->getTableName($this->tableCartProduct);
		
        $tableOrder = $this->getTableName($this->tableOrder);
		
        $tableOrderDetail = $this->getTableName($this->tableOrderDetail);
		
        $tableOrderReturn = $this->getTableName($this->tableOrderReturn);
		
        $tableOrderReturnDetail = $this->getTableName($this->tableOrderReturnDetail);
		
        $tableProduct = $this->getTableName($this->tableProduct);
		
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`num` BIGINT(19) NOT NULL AUTO_INCREMENT, ';
        $query[] = '`count` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`num`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryVersion = $query;
		
		$queryVersion = str_replace('%table%', $tableVersion, $queryVersion);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`cart_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`customer_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`cart_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryCart = $query;
		
		$queryCart = str_replace('%table%', $tableCart, $queryCart);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`cart_product_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`cart_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`cart_product_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryCartProduct = $query;
		
		$queryCartProduct = str_replace('%table%', $tableCartProduct, $queryCartProduct);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`order_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`cart_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`customer_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`total` DECIMAL(17,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`total_paid` DECIMAL(17,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`return` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`invoice_date` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`delivery_date` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = 'PRIMARY KEY (`order_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryOrder = $query;
		
		$queryOrder = str_replace('%table%', $tableOrder, $queryOrder);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`order_detail_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`order_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_quantity` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_quantity_return` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`total` DECIMAL(17,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`total_paid` DECIMAL(17,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`return` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`order_detail_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryOrderDetail = $query;
		
		$queryOrderDetail = str_replace('%table%', $tableOrderDetail, $queryOrderDetail);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`order_return_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`order_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`customer_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`question` TEXT NOT NULL DEFAULT, ';
        $query[] = 'PRIMARY KEY (`order_return_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryOrderReturn = $query;
		
		$queryOrderReturn = str_replace('%table%', $tableOrderReturn, $queryOrderReturn);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`order_return_detail_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`order_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`customer_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`order_detail_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`order_return_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_quantity` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`order_return_detail_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryOrderReturnDetail = $query;
		
		$queryOrderReturnDetail = str_replace('%table%', $tableOrderReturnDetail, $queryOrderReturnDetail);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`product_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`product_quantity` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`price` DECIMAL(17,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`name` varchar(255) NOT NULL, ';
        $query[] = 'PRIMARY KEY (`product_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryProduct = $query;
		
		$queryProduct = str_replace('%table%', $tableProduct, $queryProduct);
		
		
		if ($versionDb < $version)
		{
			$query = $queryVersion;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryCart;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryCartProduct;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryOrder;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryOrderDetail;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryOrderReturn;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryOrderReturnDetail;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$query = $queryProduct;
			
			$stmt = $dbAdapter->query($query);
            
			$stmt->closeCursor();
			
            
			$this->_setVersion($dbAdapter, $tableVersion, $version);
		}
		
		return $this;
	}
}


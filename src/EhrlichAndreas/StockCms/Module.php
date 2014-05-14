<?php 

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_StockCms_Module extends EhrlichAndreas_AbstractCms_Module
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
     * Constructor
     * 
     * @param array $options
     *            Associative array of options
     * @throws EhrlichAndreas_StockCms_Exception
     * @return void
     */
    public function __construct ($options = array())
    {
        $options = $this->_getCmsConfigFromAdapter($options);
        
        if (! isset($options['adapterNamespace']))
        {
            $options['adapterNamespace'] = 'EhrlichAndreas_StockCms_Adapter';
        }
        
        if (! isset($options['exceptionclass']))
        {
            $options['exceptionclass'] = 'EhrlichAndreas_StockCms_Exception';
        }
        
        parent::__construct($options);
    }
    
    /**
     * 
     * @return EhrlichAndreas_StockCms_Module
     */
    public function install()
    {
        $this->adapter->install();
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getTableCart ()
    {
        return $this->adapter->getTableName($this->tableCart);
    }

    /**
     * 
     * @return string
     */
    public function getTableCartProduct ()
    {
        return $this->adapter->getTableName($this->tableCartProduct);
    }

    /**
     * 
     * @return string
     */
    public function getTableOrder ()
    {
        return $this->adapter->getTableName($this->tableOrder);
    }

    /**
     * 
     * @return string
     */
    public function getTableOrderDetail ()
    {
        return $this->adapter->getTableName($this->tableOrderDetail);
    }

    /**
     * 
     * @return string
     */
    public function getTableOrderReturn ()
    {
        return $this->adapter->getTableName($this->tableOrderReturn);
    }

    /**
     * 
     * @return string
     */
    public function getTableOrderReturnDetail ()
    {
        return $this->adapter->getTableName($this->tableOrderReturnDetail);
    }

    /**
     * 
     * @return string
     */
    public function getTableProduct ()
    {
        return $this->adapter->getTableName($this->tableProduct);
    }

    /**
     * 
     * @return array
     */
    public function getFieldsCart ()
    {
        return array
        (
            'cart_id'       => 'cart_id',
            'published'     => 'published',
            'updated'       => 'updated',
            'enabled'       => 'enabled',
            'customer_id'   => 'customer_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsCartProduct ()
    {
        return array
        (
            'cart_product_id'   => 'cart_product_id',
            'published'         => 'published',
            'updated'           => 'updated',
            'enabled'           => 'enabled',
            'cart_id'           => 'cart_id',
            'customer_id'       => 'customer_id',
            'product_id'        => 'product_id',
            'product_quantity'  => 'product_quantity',
            'extern_id'         => 'extern_id',
            'extern_id_type'    => 'extern_id_type',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsOrder ()
    {
        return array
        (
            'order_id'      => 'order_id',
            'published'     => 'published',
            'updated'       => 'updated',
            'enabled'       => 'enabled',
            'cart_id'       => 'cart_id',
            'customer_id'   => 'customer_id',
            'total'         => 'total',
            'total_paid'    => 'total_paid',
            'return'        => 'return',
            'invoice_date'  => 'invoice_date',
            'delivery_date' => 'delivery_date',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsOrderDetail ()
    {
        return array
        (
            'order_detail_id'           => 'order_detail_id',
            'published'                 => 'published',
            'updated'                   => 'updated',
            'enabled'                   => 'enabled',
            'order_id'                  => 'order_id',
            'product_id'                => 'product_id',
            'product_quantity'          => 'product_quantity',
            'product_quantity_return'   => 'product_quantity_return',
            'total'                     => 'total',
            'total_paid'                => 'total_paid',
            'return'                    => 'return',
            'extern_id'                 => 'extern_id',
            'extern_id_type'            => 'extern_id_type',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsOrderReturn ()
    {
        return array
        (
            'order_return_id'   => 'order_return_id',
            'published'         => 'published',
            'updated'           => 'updated',
            'enabled'           => 'enabled',
            'order_id'          => 'order_id',
            'customer_id'       => 'customer_id',
            'question'          => 'question',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsOrderReturnDetail ()
    {
        return array
        (
            'order_return_detail_id'    => 'order_return_detail_id',
            'published'                 => 'published',
            'updated'                   => 'updated',
            'enabled'                   => 'enabled',
            'order_id'                  => 'order_id',
            'customer_id'               => 'customer_id',
            'product_id'                => 'product_id',
            'order_detail_id'           => 'order_detail_id',
            'order_return_id'           => 'order_return_id',
            'product_quantity'          => 'product_quantity',
            'extern_id'                 => 'extern_id',
            'extern_id_type'            => 'extern_id_type',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsProduct ()
    {
        return array
        (
            'product_id'        => 'product_id',
            'published'         => 'published',
            'updated'           => 'updated',
            'enabled'           => 'enabled',
            'product_quantity'  => 'product_quantity',
            'price'             => 'price',
            'name'              => 'name',
            'extern_id'         => 'extern_id',
            'extern_id_type'    => 'extern_id_type',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsCart ()
    {
        return array
        (
            'cart_id'   => 'cart_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsCartProduct ()
    {
        return array
        (
            'cart_product_id'   => 'cart_product_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsOrder ()
    {
        return array
        (
            'order_id'  => 'order_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsOrderDetail ()
    {
        return array
        (
            'order_detail_id'   => 'order_detail_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsOrderReturn ()
    {
        return array
        (
            'order_return_id'   => 'order_return_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsOrderReturnDetail ()
    {
        return array
        (
            'order_return_detail_id'    => 'order_return_detail_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsProduct ()
    {
        return array
        (
            'product_id'    => 'product_id',
        );
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addCart ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['customer_id']))
        {
            $params['customer_id'] = '0';
        }
        
        $function = 'Cart';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addCartProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['cart_id']))
        {
            $params['cart_id'] = '0';
        }
        
        if (! isset($params['customer_id']))
        {
            $params['customer_id'] = '0';
        }
        
        if (! isset($params['product_id']))
        {
            $params['product_id'] = '0';
        }
        
        if (! isset($params['product_quantity']))
        {
            $params['product_quantity'] = '0';
        }
        
        if (! isset($params['extern_id']))
        {
            $params['extern_id'] = '0';
        }
        
        if (! isset($params['extern_id_type']))
        {
            $params['extern_id_type'] = '0';
        }
        
        $function = 'CartProduct';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addOrder ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['cart_id']))
        {
            $params['cart_id'] = '0';
        }
        
        if (! isset($params['customer_id']))
        {
            $params['customer_id'] = '0';
        }
        
        if (! isset($params['total']))
        {
            $params['total'] = '0.00';
        }
        
        if (! isset($params['total_paid']))
        {
            $params['total_paid'] = '0.00';
        }
        
        if (! isset($params['return']))
        {
            $params['return'] = '0';
        }
        
        if (! isset($params['invoice_date']))
        {
            $params['invoice_date'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['delivery_date']))
        {
            $params['delivery_date'] = '0001-01-01 00:00:00';
        }
        
        $function = 'Order';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addOrderDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['order_id']))
        {
            $params['order_id'] = '0';
        }
        
        if (! isset($params['product_id']))
        {
            $params['product_id'] = '0';
        }
        
        if (! isset($params['product_quantity']))
        {
            $params['product_quantity'] = '0';
        }
        
        if (! isset($params['product_quantity_return']))
        {
            $params['product_quantity_return'] = '0';
        }
        
        if (! isset($params['total']))
        {
            $params['total'] = '0.00';
        }
        
        if (! isset($params['total_paid']))
        {
            $params['total_paid'] = '0.00';
        }
        
        if (! isset($params['return']))
        {
            $params['return'] = '0';
        }
        
        if (! isset($params['extern_id']))
        {
            $params['extern_id'] = '0';
        }
        
        if (! isset($params['extern_id_type']))
        {
            $params['extern_id_type'] = '0';
        }
        
        $function = 'OrderDetail';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addOrderReturn ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['order_id']))
        {
            $params['order_id'] = '0';
        }
        
        if (! isset($params['customer_id']))
        {
            $params['customer_id'] = '0';
        }
        
        if (! isset($params['message']))
        {
            $params['message'] = '';
        }
        
        $function = 'OrderReturn';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['order_id']))
        {
            $params['order_id'] = '0';
        }
        
        if (! isset($params['customer_id']))
        {
            $params['customer_id'] = '0';
        }
        
        if (! isset($params['product_id']))
        {
            $params['product_id'] = '0';
        }
        
        if (! isset($params['order_detail_id']))
        {
            $params['order_detail_id'] = '0';
        }
        
        if (! isset($params['order_return_id']))
        {
            $params['order_return_id'] = '0';
        }
        
        if (! isset($params['product_quantity']))
        {
            $params['product_quantity'] = '0';
        }
        
        if (! isset($params['extern_id']))
        {
            $params['extern_id'] = '0';
        }
        
        if (! isset($params['extern_id_type']))
        {
            $params['extern_id_type'] = '0';
        }
        
        $function = 'OrderReturnDetail';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['name']))
        {
            $params['name'] = '';
        }
        
        if (! isset($params['product_quantity']))
        {
            $params['product_quantity'] = '0';
        }
        
        if (! isset($params['price']))
        {
            $params['price'] = '0.00';
        }
        
        $function = 'Product';
        
        return $this->_add($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteCart ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'Cart';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteCartProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'CartProduct';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteOrder ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'Order';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteOrderDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'OrderDetail';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteOrderReturn ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'OrderReturn';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'OrderReturnDetail';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'Product';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editCart ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'Cart';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editCartProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'CartProduct';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editOrder ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'Order';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editOrderDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'OrderDetail';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editOrderReturn ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'OrderReturn';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'OrderReturnDetail';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'Product';
        
        return $this->_edit($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getCart ($params = array(), $returnAsString = false)
    {
        $function = 'Cart';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getCartList ($where = array())
    {
        $function = 'Cart';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getCartProduct ($params = array(), $returnAsString = false)
    {
        $function = 'CartProduct';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getCartProductList ($where = array())
    {
        $function = 'CartProduct';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getOrder ($params = array(), $returnAsString = false)
    {
        $function = 'Order';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getOrderList ($where = array())
    {
        $function = 'Order';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getOrderDetail ($params = array(), $returnAsString = false)
    {
        $function = 'OrderDetail';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getOrderDetailList ($where = array())
    {
        $function = 'OrderDetail';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getOrderReturn ($params = array(), $returnAsString = false)
    {
        $function = 'OrderReturn';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getOrderReturnList ($where = array())
    {
        $function = 'OrderReturn';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        $function = 'OrderReturnDetail';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getOrderReturnDetailList ($where = array())
    {
        $function = 'OrderReturnDetail';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getProduct ($params = array(), $returnAsString = false)
    {
        $function = 'Product';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getProductList ($where = array())
    {
        $function = 'Product';
        
        return $this->_getList($function, $where);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableCart ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editCart($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableCartProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editCartProduct($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableOrder ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editOrder($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableOrderDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editOrderDetail($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableOrderReturn ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editOrderReturn($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editOrderReturnDetail($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editProduct($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableCart ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editCart($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableCartProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editCartProduct($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableOrder ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editOrder($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableOrderDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editOrderDetail($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableOrderReturn ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editOrderReturn($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editOrderReturnDetail($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableProduct ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editProduct($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteCart ($params = array(), $returnAsString = false)
    {
        return $this->disableCart($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteCartProduct ($params = array(), $returnAsString = false)
    {
        return $this->disableCartProduct($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteOrder ($params = array(), $returnAsString = false)
    {
        return $this->disableOrder($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteOrderDetail ($params = array(), $returnAsString = false)
    {
        return $this->disableOrderDetail($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteOrderReturn ($params = array(), $returnAsString = false)
    {
        return $this->disableOrderReturn($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteOrderReturnDetail ($params = array(), $returnAsString = false)
    {
        return $this->disableOrderReturnDetail($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteProduct ($params = array(), $returnAsString = false)
    {
        return $this->disableProduct($params, $returnAsString);
    }
    
}


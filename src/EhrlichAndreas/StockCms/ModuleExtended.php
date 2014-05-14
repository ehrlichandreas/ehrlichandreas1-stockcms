<?php

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_StockCms_ModuleExtended extends EhrlichAndreas_StockCms_Module
{
    /**
     * 
     * @param string $count
     * @return mixed
     */
    protected function _getCount($count)
    {
        if (is_array($count))
        {
            if (isset($count['count']))
            {
                $count = $count['count'];
            }
            else
            {
                return false;
            }
        }
        
        return $count;
    }
    
    /**
     * 
     * @param string $customer_id
     * @return mixed
     */
    protected function _getCustomerId($customer_id)
    {
        if (is_array($customer_id))
        {
            if (isset($customer_id['customer_id']))
            {
                $customer_id = $customer_id['customer_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $customer_id;
    }
    
    /**
     * 
     * @param string $customer_id
     * @return mixed
     */
    protected function _getProductId($product_id)
    {
        if (is_array($product_id))
        {
            if (isset($product_id['product_id']))
            {
                $product_id = $product_id['product_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $product_id;
    }
    
    protected function _getCartId($customer_id)
    {
        $param = array
        (
            'where' => array
            (
                'customer_id'   => $customer_id,
                'enabled'       => '1',
            ),
            'limit' => '1',
        );
        
        $rowset = $this->getCart($param);
        
        $cart_id = '0';
        
        if (count($rowset) == 0)
        {
            $param = array
            (
                'customer_id'   => $customer_id,
                'enabled'       => '1',
            );
            
            $cart_id = $this->addCart($param);
        }
        else
        {
            $cart_id = $rowset[0]['cart_id'];
        }
        
        return $cart_id;
    }
    
    /**
     * 
     * @param string $extern_id
     * @return mixed
     */
    protected function _getExternId($extern_id)
    {
        if (is_array($extern_id))
        {
            if (isset($extern_id['extern_id']))
            {
                $extern_id = $extern_id['extern_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $extern_id;
    }
    
    /**
     * 
     * @param string $extern_id
     * @return mixed
     */
    protected function _getExternIdType($extern_id_type)
    {
        if (is_array($extern_id_type))
        {
            if (isset($extern_id_type['extern_id_type']))
            {
                $extern_id_type = $extern_id_type['extern_id_type'];
            }
            else
            {
                return false;
            }
        }
        
        return $extern_id_type;
    }
    
    /**
     * 
     * @param string $product
     * @param boolean $checkExtern
     * @return mixed
     */
    public function addProductToStock($product, $checkExtern = false)
    {
        $product_id_tmp = $this->_getProductId($product);
        
        $extern_id_tmp = $this->_getExternId($product);
        
        $extern_id_type_tmp = $this->_getExternIdType($product);
        
        if ($checkExtern && $extern_id_tmp === false)
        {
            return false;
        }
        
        if ($product_id_tmp === false)
        {
            return $this->addProduct($product);
        }
        
        $product_id = $product_id_tmp;
        
        $param = array
        (
            'where' => array
            (
                'product_id'    => $product_id,
                #'enabled'       => '1',
            ),
        );
        
        $rowset = $this->getProduct($param);
        
        if (count($rowset) == 0)
        {
            return $this->addProduct($product);
        }
        
        $param = array
        (
            'where' => array
            (
                'product_id'    => $product_id,
                #'enabled'       => '1',
            ),
        );
        
        if (isset($product['product_quantity']))
        {
            $cellname = $this->getConnection()->quoteIdentifier('product_quantity');
            
            $count = abs($product['product_quantity']);
            
            $count = $this->getConnection()->quote($count);
            
            $param['product_quantity'] = new EhrlichAndreas_Db_Expr($cellname . ' + ' . $count);
        }
        
        if (isset($product['name']))
        {
            $param['name'] = $product['name'];
        }
        
        if (isset($product['enabled']))
        {
            $param['enabled'] = $product['enabled'];
        }
        
        if (isset($product['price']))
        {
            $param['price'] = abs($product['price']);
        }
        
        if ($extern_id_tmp !== false)
        {
            $param['extern_id'] = $extern_id_tmp;
        }
        
        if ($extern_id_type_tmp !== false)
        {
            $param['extern_id_type'] = $extern_id_type_tmp;
        }
        
        return $this->editProduct($param);
    }
    
    /**
     * 
     * @param string $product
     * @param boolean $checkExtern
     * @return mixed
     */
    public function addProductToCart($product, $checkExtern = false)
    {
        $customer_id_tmp = $this->_getCustomerId($product);
        
        $product_id_tmp = $this->_getProductId($product);
        
        $extern_id_tmp = $this->_getExternId($product);
        
        $extern_id_type_tmp = $this->_getExternIdType($product);
        
        $count = $this->_getCount($product);
        
        if ($checkExtern && $extern_id_tmp === false)
        {
            return false;
        }
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        if ($extern_id_tmp === false && $product_id_tmp === false)
        {
            return false;
        }
        
        if ($count === false)
        {
            $count = 1;
        }
        
        if ($product_id_tmp === false)
        {
            $param = array
            (
                'cols'  => array
                (
                    'product_id'    => 'product_id',
                ),
                'where' => array
                (
                    'extern_id'         => $extern_id_tmp,
                    'extern_id_type'    => $extern_id_type_tmp,
                ),
            );
            
            $rowset = $this->getProductList($param);
            
            if (count($rowset) == 0)
            {
                return false;
            }
            else
            {
                $product_id_tmp = $rowset[0]['product_id'];
            }
        }
        
        $customer_id = $customer_id_tmp;
        
        $product_id = $product_id_tmp;
        
        $count = abs($count);
        
        $cart_id = $this->_getCartId($customer_id);
        
        $param = array
        (
            'where' => array
            (
                'cart_id'       => $cart_id,
                'customer_id'   => $customer_id,
                'product_id'    => $product_id,
                'enabled'       => '1',
            ),
            'limit' => '1',
        );
        
        $rowset = $this->getCartProduct($param);
        
        if (count($rowset) == 0)
        {
            $param = array
            (
                'cart_id'           => $cart_id,
                'customer_id'       => $customer_id,
                'product_id'        => $product_id,
                'product_quantity'  => $count,
                'enabled'           => '1',
            );
        
            if ($extern_id_tmp !== false)
            {
                $param['extern_id'] = $extern_id_tmp;
            }

            if ($extern_id_type_tmp !== false)
            {
                $param['extern_id_type'] = $extern_id_type_tmp;
            }

            return (bool) $this->addCartProduct($param);
        }
        else
        {
            $cellname = $this->getConnection()->quoteIdentifier('product_quantity');
            
            $count = $this->getConnection()->quote($count);
            
            $param = array
            (
                'product_quantity'  => new EhrlichAndreas_Db_Expr($cellname . ' + ' . $count),
                'where' => array
                (
                    'cart_id'       => $cart_id,
                    'customer_id'   => $customer_id,
                    'product_id'    => $product_id,
                    'enabled'       => '1',
                ),
            );

            return (bool) $this->editCartProduct($param);
        }
    }
    
    /**
     * 
     * @param string $product
     * @param boolean $checkExtern
     * @return mixed
     */
    public function deleteProductFromCart($product, $checkExtern = false)
    {
        $customer_id_tmp = $this->_getCustomerId($product);
        
        $product_id_tmp = $this->_getProductId($product);
        
        $extern_id_tmp = $this->_getExternId($product);
        
        $extern_id_type_tmp = $this->_getExternIdType($product);
        
        if ($checkExtern && $extern_id_tmp === false)
        {
            return false;
        }
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        if ($extern_id_tmp === false && $product_id_tmp === false)
        {
            return false;
        }
        
        if ($product_id_tmp === false)
        {
            $param = array
            (
                'cols'  => array
                (
                    'product_id'    => 'product_id',
                ),
                'where' => array
                (
                    'extern_id'         => $extern_id_tmp,
                    'extern_id_type'    => $extern_id_type_tmp,
                ),
            );
            
            $rowset = $this->getProductList($param);
            
            if (count($rowset) == 0)
            {
                return false;
            }
            else
            {
                $product_id_tmp = $rowset[0]['product_id'];
            }
        }
        
        $customer_id = $customer_id_tmp;
        
        $product_id = $product_id_tmp;
        
        $cart_id = $this->_getCartId($customer_id);
        
        $param = array
        (
            'where' => array
            (
                'cart_id'       => $cart_id,
                'customer_id'   => $customer_id,
                'product_id'    => $product_id,
                'enabled'       => '1',
            ),
        );

        return (bool) $this->deleteCartProduct($param);
    }
    
    /**
     * 
     * @param string $product
     * @param boolean $checkExtern
     * @return mixed
     */
    public function editProductInCart($product, $checkExtern = false)
    {
        $customer_id_tmp = $this->_getCustomerId($product);
        
        $product_id_tmp = $this->_getProductId($product);
        
        $extern_id_tmp = $this->_getExternId($product);
        
        $extern_id_type_tmp = $this->_getExternIdType($product);
        
        $count = $this->_getCount($product);
        
        if ($checkExtern && $extern_id_tmp === false)
        {
            return false;
        }
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        if ($extern_id_tmp === false && $product_id_tmp === false)
        {
            return false;
        }
        
        if ($count === false)
        {
            $count = 1;
        }
        
        if ($product_id_tmp === false)
        {
            $param = array
            (
                'cols'  => array
                (
                    'product_id'    => 'product_id',
                ),
                'where' => array
                (
                    'extern_id'         => $extern_id_tmp,
                    'extern_id_type'    => $extern_id_type_tmp,
                ),
            );
            
            $rowset = $this->getProductList($param);
            
            if (count($rowset) == 0)
            {
                return false;
            }
            else
            {
                $product_id_tmp = $rowset[0]['product_id'];
            }
        }
        
        $customer_id = $customer_id_tmp;
        
        $product_id = $product_id_tmp;
        
        $count = abs($count);
        
        if ($count == 0)
        {
            return $this->deleteProductFromCart($customer_id, $product_id);
        }
        
        $cart_id = $this->_getCartId($customer_id);
        
        $param = array
        (
            'where' => array
            (
                'cart_id'       => $cart_id,
                'customer_id'   => $customer_id,
                'product_id'    => $product_id,
                'enabled'       => '1',
            ),
            'limit' => '1',
        );
        
        $rowset = $this->getCartProduct($param);
        
        if (count($rowset) == 0)
        {
            $param = array
            (
                'cart_id'           => $cart_id,
                'customer_id'       => $customer_id,
                'product_id'        => $product_id,
                'product_quantity'  => $count,
                'enabled'           => '1',
            );
        
            if ($extern_id_tmp !== false)
            {
                $param['extern_id'] = $extern_id_tmp;
            }

            if ($extern_id_type_tmp !== false)
            {
                $param['extern_id_type'] = $extern_id_type_tmp;
            }

            return (bool) $this->addCartProduct($param);
        }
        else
        {
            $cellname = $this->getConnection()->quoteIdentifier('product_quantity');
            
            $count = $this->getConnection()->quote($count);
            
            $param = array
            (
                'product_quantity'  => $count,
                'where' => array
                (
                    'cart_id'       => $cart_id,
                    'customer_id'   => $customer_id,
                    'product_id'    => $product_id,
                    'enabled'       => '1',
                ),
            );

            return (bool) $this->editCartProduct($param);
        }
    }
    
    /**
     * 
     * @param string $customer_id
     * @return mixed
     */
    public function emptyCart($customer_id)
    {
        $customer_id_tmp = $this->_getCustomerId($customer_id);
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        $customer_id = $customer_id_tmp;
        
        $cart_id = $this->_getCartId($customer_id);
        
        $param = array
        (
            'where' => array
            (
                'cart_id'       => $cart_id,
                'customer_id'   => $customer_id,
                'enabled'       => '1',
            ),
        );

        return (bool) $this->deleteCartProduct($param);
    }
    
    /**
     * 
     * @param string $customer_id
     * @return mixed
     */
    public function createOrderFromCart($customer_id)
    {
        $customer_id_tmp = $this->_getCustomerId($customer_id);
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        $customer_id = $customer_id_tmp;
        
        $cart_id = $this->_getCartId($customer_id);
        
        $param = array
        (
            'where' => array
            (
                'cart_id'       => $cart_id,
                'customer_id'   => $customer_id,
                'enabled'       => '1',
            ),
        );
        
        $rowset = $this->getCartProductList($param);
        
        if (count($rowset) == 0)
        {
            return false;
        }
        
        $rowsetCartProduct = array();
        
        foreach ($rowset as $row)
        {
            $rowsetCartProduct[$row['product_id']] = $row;
        }
        
        $product_ids = array_keys($rowsetCartProduct);
        
        $product_ids = array_combine($product_ids, $product_ids);
        
        $param = array
        (
            'product_id'    => $product_ids,
            'enabled'       => '1',
        );
        
        $rowset = $this->getProductList($param);
        
        $total = 0;
        
        foreach ($rowset as $row)
        {
            $total = $total + $row['price'] * $rowsetCartProduct[$row['product_id']]['product_quantity'];
            
            $rowsetCartProduct[$row['product_id']]['price'] = $row['price'];
            
            $rowsetCartProduct[$row['product_id']]['total'] = $row['price'] * $rowsetCartProduct[$row['product_id']]['product_quantity'];
        }
        
        $param = array
        (
            'customer_id'   => $customer_id,
            'cart_id'       => $cart_id,
            'enabled'       => '1',
            'invoice_date'  => date('Y-m-d H:i:s', time()),
            'total'         => $total,
        );
        
        $order_id = $this->addOrder($param);
        
        foreach ($rowsetCartProduct as $rowCartProduct)
        {
            $param = array
            (
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'cart_id'           => $cart_id,
                'product_id'        => $rowCartProduct['product_id'],
                'product_quantity'  => $rowCartProduct['product_quantity'],
                'extern_id'         => $rowCartProduct['extern_id'],
                'extern_id_type'    => $rowCartProduct['extern_id_type'],
                'enabled'           => '1',
            );
            
            if (isset($rowCartProduct['total']))
            {
                $param['total'] = $rowCartProduct['total'];
            }
            
            $this->addOrderDetail($param);
        }
        
        $this->emptyCart($customer_id);
    }
}


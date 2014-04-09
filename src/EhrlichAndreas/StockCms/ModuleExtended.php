<?php

/**
 * Library base exception
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_StockCms_ModuleExtended extends EhrlichAndreas_StockCms_Module
{
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
     * @param string $customer_id
     * @param string $product_id
     * @return mixed
     */
    public function addProductToCart($customer_id, $product_id, $count = 1)
    {
        $customer_id_tmp = $this->_getCustomerId($customer_id);
        
        $product_id_tmp = $this->_getProductId($product_id);
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        if ($product_id_tmp === false)
        {
            return false;
        }
        
        $customer_id = $customer_id_tmp;
        
        $product_id = $product_id_tmp;
        
        $count = abs($count);
        
        if ($count == 0)
        {
            return false;
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
    
    public function deleteProductFromCart($customer_id, $product_id)
    {
        $customer_id_tmp = $this->_getCustomerId($customer_id);
        
        $product_id_tmp = $this->_getProductId($product_id);
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        if ($product_id_tmp === false)
        {
            return false;
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
    
    public function editProductInCart($customer_id, $product_id, $count = 1)
    {
        $customer_id_tmp = $this->_getCustomerId($customer_id);
        
        $product_id_tmp = $this->_getProductId($product_id);
        
        if ($customer_id_tmp === false)
        {
            return false;
        }
        
        if ($product_id_tmp === false)
        {
            return false;
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
}


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
     * @param string $product_id
     * @return mixed
     */
    public function addProductToCart($customer_id, $product_id, $count = 1)
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
        
        $count = abs($count);
        
        if ($count == 0)
        {
            return false;
        }
        
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
    
    public function editProductFromCart($customer_id, $product_id, $count = 1)
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
        
        $count = abs($count);
    }
    
    public function deleteProductFromCart($customer_id, $product_id, $count = 1)
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
    }
}


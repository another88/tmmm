<?php
class Product extends MetaModelBase
{
    public $tableName='product';  
    
    public function urlDetail($url)
    {
        $sql = 'SELECT *
                    FROM `product`
                    WHERE `deleted` = 0
                        AND `approved` = 1
                        AND `url` = '.$this->_db->quote($url);
        return $this->_db->fetchRow($sql);
    }      
    
    public function addProductCount($productId, $type)
    {
        if( $type == 'view' )
        {
            $sql = "UPDATE `product`
                        SET `viewCount` = `product`.`viewCount`+1
                WHERE `productId` =".intval($productId);
        }
        elseif( $type == 'buy' )
        {
            $sql = "UPDATE `product`
                        SET `buyCount` = `product`.`buyCount`+1
                WHERE `productId` =".intval($productId);            
        }
        $this->_db->query($sql);
    }        
    
    public function getMostViewed($categoryId=0, $limit=6)
    {
        $sql = 'SELECT *
                    FROM `product`
                    WHERE `deleted` = 0
                        AND `approved` = 1';
//        if($categoryId!=0)
//        {
//            $sql .= ' AND `productCategoryId`  ';
//        }
        $sql .= ' ORDER by `viewCount` DESC'    
                .' LIMIT 0,'.(int)$limit;
        return $this->_db->fetchAll($sql);
    }  
    
    public function getMostBuyed($categoryId=0, $limit=6)
    {
        $sql = 'SELECT *
                    FROM `product`
                    WHERE `deleted` = 0
                        AND `approved` = 1'
                .' ORDER by `buyCount` DESC'    
                .' LIMIT 0,'.(int)$limit;
        return $this->_db->fetchAll($sql);
    }   
    
//    public function getMostBuyedAndViewed($limit=6)
//    {
//        $sql = 'SELECT *
//                    FROM `product`
//                    WHERE `deleted` = 0
//                        AND `approved` = 1'
//                .' ORDER by `buyCount` DESC'    
//                .' LIMIT 0,'.(int)$limit/2;
//        $arr1 = $this->_db->fetchAll($sql);
//        
//        $sql2 = 'SELECT *
//                    FROM `product`
//                    WHERE `deleted` = 0
//                        AND `approved` = 1 
//                    ORDER by `viewCount` DESC    
//                 LIMIT 0,'.(int)$limit/2;
//        $arr2 = $this->_db->fetchAll($sql2);
//        
//        $result = array_merge ($arr1, $arr2);
//        return $result;
//    }       
}

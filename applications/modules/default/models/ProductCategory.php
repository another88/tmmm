<?php
class ProductCategory extends MetaModelBase
{
    public $tableName='productcategory';
    
    public function urlDetail($url)
    {
        $sql = 'SELECT *
                    FROM `productcategory`
                    WHERE `deleted` = 0
                        AND `approved` = 1
                        AND `url` = '.$this->_db->quote($url);
        return $this->_db->fetchRow($sql);
    }          
 
}

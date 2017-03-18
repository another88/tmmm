<?php
class GuestSale extends MetaModelBase
{
    public $tableName='guestsale';
    
    public function getPercent($code)
    {
        $sql = 'SELECT `salePercent`
                    FROM `guestsale` 
                WHERE `deleted` = 0 AND `approved` = 1 AND `code` = '.$this->_db->quote($code);
        $res = $this->_db->fetchRow($sql);
        
        return $res;
    }  

    public function getSaleDet($code)
    {
        $sql = 'SELECT *
                    FROM `guestsale` 
                WHERE `deleted` = 0 AND `approved` = 1 AND `code` = '.$this->_db->quote($code);
        $res = $this->_db->fetchRow($sql);
        
        return $res;
    }      
    
}
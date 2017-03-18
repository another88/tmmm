<?php
class ConsBludce extends MetaModelBase
{
    public $tableName='consbludce';  
    
    public function getData()
    {
        $sql = 'SELECT *, consBludceId as elementId, "consbludce" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }   
    
//    public function getElementDetails($code, $id)
//    {
//        $sql = 'SELECT *
//                    FROM `cons'.$code.'`
//                    WHERE `deleted` = 0
//                        AND `approved` = 1
//                        AND ``';
//        return $this->_db->fetchAll($sql);
//    }       
}

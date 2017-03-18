<?php
class Constructor extends MetaModelBase
{
    public $tableName='constructor';  
    
    public function checkParam($data)
    {
        $sql = 'SELECT constructorId
                    FROM '.$this->tableName.'
                WHERE `deleted` = 0
                    AND `bludceId` = '.(int)$data['bludceId'].'
                     AND `bowlId` = '.(int)$data['bowlId'].'
                     AND `kolbaId` = '.(int)$data['kolbaId'].'
                     AND `shaxtaId` = '.(int)$data['shaxtaId'].'
                     AND `shipciId` = '.(int)$data['shipciId'].'
                     AND `trybkaId` = '.(int)$data['trybkaId'];
        $res = $this->_db->fetchRow($sql);
        if( empty($res) )
            return true;
        else
            return false;
    }        
}

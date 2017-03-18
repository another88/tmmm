<?php
class ConsShipci extends MetaModelBase
{
    public $tableName='consshipci';  
    
    public function getData()
    {
        $sql = 'SELECT *, consShipciId as elementId, "consshipci" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }       
}

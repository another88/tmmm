<?php
class ConsPortV extends MetaModelBase
{
    public $tableName='consportv';  
    
    public function getData()
    {
        $sql = 'SELECT *, consPortVId as elementId, "consportv" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }        
}

<?php
class ConsPortN extends MetaModelBase
{
    public $tableName='consportn';  
    
    public function getData()
    {
        $sql = 'SELECT *, consPortNId as elementId, "consportn" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }   
}

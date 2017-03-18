<?php
class ConsShaxta extends MetaModelBase
{
    public $tableName='consshaxta';  
    
    public function getData()
    {
        $sql = 'SELECT *, consShaxtaId as elementId, "consshaxta" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }        
}

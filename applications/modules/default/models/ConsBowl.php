<?php
class ConsBowl extends MetaModelBase
{
    public $tableName='consbowl';  
    
    public function getData()
    {
        $sql = 'SELECT *, consBowlId as elementId, "consbowl" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }          
}

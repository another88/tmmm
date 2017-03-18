<?php
class Setting extends MetaModelBase
{
    public $tableName='setting';  
    
    public function getSetting($code)
    {
        $sql = 'SELECT *
                    FROM `setting`
                    WHERE `deleted` = 0
                        AND `approved` = 1
                        AND `code` = '.$this->_db->quote($code);
        return $this->_db->fetchRow($sql);
    }    
    
    public function setSetting($code, $value)
    {
        $sql = 'UPDATE `setting` SET `value`='.$this->_db->quote($value).' WHERE `code` = '.$this->_db->quote($code);
        $this->_db->query($sql);
    }        
}

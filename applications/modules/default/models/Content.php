<?php
class Content extends MetaModelBase
{
    public $tableName='content';
    
    public function urlDetail($url)
    {
        $sql = 'SELECT *
                    FROM `content`
                    WHERE `deleted` = 0
                        AND `url` = '.$this->_db->quote($url);
        return $this->_db->fetchRow($sql);
    }       
    
    public function addViewCount($id)
    {

        $sql = "UPDATE `content`
                    SET `veiwCount` = `content`.`veiwCount`+1
            WHERE `contentId` =".intval($id);
        $this->_db->query($sql);
    }      
}

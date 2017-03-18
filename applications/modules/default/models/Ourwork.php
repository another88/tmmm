<?php
class Ourwork extends MetaModelBase
{
    public $tableName='ourwork';  

    public function addLike($id)
    {

        $sql = "UPDATE `ourwork`
                    SET `likeCount` = `ourwork`.`likeCount`+1
            WHERE `ourWorkId` =".intval($id);
        $this->_db->query($sql);
    }          
}

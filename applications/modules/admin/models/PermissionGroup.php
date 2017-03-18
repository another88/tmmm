<?php

class PermissionGroup extends MetaModelBase 
{

    public $tableName = 'permission_group';

    public function delete($id) {
        $sql = 'DELETE FROM 
                    '.$this->tablePrefix.'permission_group_user
                WHERE
                    permission_groupId='.(int)$id;
        $this->_db->query($sql);
        $sql = 'DELETE FROM '.$this->tablePrefix.'permission_group WHERE permission_groupId=' . (int) $id;
        $this->_db->query($sql);
    }

}

?>

<?php
class PermissionGroupObject extends MetaModelBase
{
    public $tableName = 'permission_group_object';

    public function deleteOwn($pg, $po)
    {
        $sql='  DELETE FROM '.$this->tablePrefix.$this->tableName.' 
                WHERE 
                    permission_groupId = '.(int)$pg.' AND permission_objectId='.(int)$po;
        $this->_db->query($sql);
    }
}
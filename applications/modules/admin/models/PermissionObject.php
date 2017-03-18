<?php
class PermissionObject extends MetaModelBase
{
    public $tableName = 'permission_object';
    
    public function getGroupObject($permissionGroupId)
    {
        $sql = 'SELECT
                                po.*,
                                pgo.*,
                                po.permission_objectId as realId,
                                po.description as realDescription
                        FROM
                                '.$this->tablePrefix.'permission_object po
                        LEFT OUTER JOIN
                                '.$this->tablePrefix.'permission_group_object pgo
                        ON
                                pgo.permission_objectId = po.permission_objectId
                                        AND
                                pgo.permission_groupId = '.$permissionGroupId;
        return $this->_db->fetchAll($sql);
    }
    
    public function delete($id)
    {
        $sql=' DELETE FROM
                    '.$this->tablePrefix.$this->tableName.'
                WHERE 
                        permission_objectId='.(int)$id;
        $this->_db->query($sql);
    }
}
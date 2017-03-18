<?php
class PermissionGroupUser extends MetaModelBase
{
    public $tableName = 'permission_group_user';

    public function getUsers($id)
    {
        $sql='
                SELECT 
                    u.email,
                    u.name,
                    p.*
                FROM
                    '.$this->tablePrefix.'permission_group_user p
                        JOIN 
                    user u
                        ON
                            p.userId = u.userId
                WHERE
                    p.permission_groupId='.(int)$id
            ;
        return $this->_db->fetchAll($sql);
    }
    
    public function delete($id)
    {
        $sql = 'DELETE FROM
                    '.$this->tablePrefix.'permission_group_user
                WHERE 
                    permission_group_userId='.(int)$id;
        $this->_db->query($sql);
    }
    
    public function getAvailable($id)
    {
        $sql='
                SELECT
                    *
                FROM
                    '.$this->tablePrefix.'user
                WHERE 
                    userId NOT IN (
                                        (SELECT 
                                            u.userId
                                        FROM
                                            '.$this->tablePrefix.'permission_group_user p
                                                JOIN 
                                            user u
                                                ON
                                                    p.userId = u.userId
                                        WHERE
                                            p.permission_groupId='.(int)$id.')
                

                                    )
                AND deleted = 0
                AND approved = 1';
        return $this->_db->fetchAll($sql);
    }
    
    public function getGroups($id)
    {
        $sql='
                SELECT
                        pg.title,
                        pg.description,
                        pgu.permission_group_userId
                FROM
                    '.$this->tablePrefix.'permission_group_user pgu
                        JOIN
                    permission_group pg
                        ON
                            pgu.permission_groupId = pg.permission_groupId
                WHERE
                    pgu.userId = '.(int)$id;
        return  $this->_db->fetchAll($sql);
    }
    
    public function getAvailableGroups($id)
    {
        $sql='
                SELECT 
                    * 
                FROM
                    '.$this->tablePrefix.'permission_group
                WHERE
                    permission_groupId NOT IN ((
                                    SELECT
                                        pg.permission_groupId
                                    FROM
                                        '.$this->tablePrefix.'permission_group_user pgu
                                            JOIN
                                        permission_group pg
                                            ON
                                                pgu.permission_groupId = pg.permission_groupId
                                    WHERE
                                        pgu.userId = '.(int)$id.'
                    ))
                ';
        return $this->_db->fetchAll($sql);
    }
}
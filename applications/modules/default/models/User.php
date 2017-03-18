<?php
class User extends MetaModelBase
{
    public $tableName='user';
    
    public function checkEmail($email)
    {
        $sql = 'SELECT *
                    FROM `user` 
                    WHERE `email` = '.$this->_db->quote($email);
        return $this->_db->fetchRow($sql);
    }       
    
    public function getUser($email, $password)
    {
        $sql = 'SELECT *
                    FROM `user` 
                    WHERE `email` = '.$this->_db->quote($email).' 
                        AND `password` = '.$this->_db->quote(MD5(MD5($password)));
        return $this->_db->fetchRow($sql);
    }      
    
    public function updateSecretKey($key, $id)
    {

        $sql = "UPDATE `user`
                    SET `secrethash` = ".$this->_db->quote($key)."
            WHERE `userId` =".intval($id);
        $this->_db->query($sql);
    }     
    
    public function getUserOnHash($hash)
    {
        $sql = 'SELECT *
                    FROM `user` 
                    WHERE `secrethash` = '.$this->_db->quote(MD5(MD5($hash)));
        return $this->_db->fetchRow($sql);
    }      
}
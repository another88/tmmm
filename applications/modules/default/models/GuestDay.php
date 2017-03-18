<?php
class GuestDay extends MetaModelBase
{
    public $tableName='guestday';
    
    public function getCurrentDay()
    {
        $sql = 'SELECT `guestDayId`
                    FROM `guestday` 
                WHERE `deleted` = 0 AND `dayisopen` = 1';
        $res = $this->_db->fetchRow($sql);
        
        return (int)$res['guestDayId'];
    }        
    
    public function clearDay($dayId)
    {
        $sql = 'UPDATE `guestday` SET `dayisopen`=0';
        if( $dayId != 0 )
        {
            $sql .= ' WHERE `guestDayId` = '.(int)$dayId;
        }        
        $this->_db->query($sql);
    }       
    
    public function getMonthDay($month)
    {
        $sql = 'SELECT *
                    FROM `guestday` 
                WHERE `deleted` = 0 AND `dayisopen` = 0 
                AND `currentDate`  LIKE '.$this->_db->quote('%'.$month.'%').''
                . ' ORDER by guestDayId DESC';
        $res = $this->_db->fetchAll($sql);
        
        return $res;
    }     
}
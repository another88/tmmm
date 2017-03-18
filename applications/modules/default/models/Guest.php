<?php
class Guest extends MetaModelBase
{
    public $tableName='guest';
    
    public function findGuest($data)
    {
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `'.$data['type'].'` LIKE '.$this->_db->quote('%'.trim($data['val']).'%').'
                    AND `deleted` = 0';
//        var_dump($sql);exit;
        return $this->_db->fetchAll($sql);
    }       
    
    public function addGuestEnter($guestId)
    {
        $sql2 = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `inside`=1
                ORDER by `insideSort` DESC
                LIMIT 1';
        $res = $this->_db->fetchRow($sql2);        
        
        if( !$res )
        {
            $newInsideNumber = 1;
        }
        else
        {
            $newInsideNumber = (int)$res['insideSort'] + 1;
        }
        
        $sql = 'UPDATE `guest` SET `inside`=1, `insideSort`= '.(int)$newInsideNumber.' WHERE `guestId` = '.(int)$guestId;
        $this->_db->query($sql);
    }   
    
    public function guestOut($guestId)
    {
        $sql = 'UPDATE `guest` SET `inside`=0, `insideSort`= 0, `inTable`= 0 WHERE `guestId` = '.(int)$guestId;
        $this->_db->query($sql);
    }       
    
    public function checkUniq($cardNumber, $id)
    {
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `cardNumber` = '.(int)$cardNumber.'
                    AND `guestId` != '.(int)$id;
        $res = $this->_db->fetchRow($sql);
        
        if( empty($res) )
            return false;
        else
            return true;
    }     
    
    public function findGuestActive($data)
    {
        $exp = explode(' ', $data['val']);
        $expCount = count($exp);
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `approved` = 1 AND `inside` = 0 AND (';
        foreach($exp as $k=>$v)
        {
            $sql .= '`cardNumber` LIKE '.$this->_db->quote('%'.$v.'%');
            $sql .= ' OR `name` LIKE '.$this->_db->quote('%'.$v.'%');
            $sql .= ' OR `secondName` LIKE '.$this->_db->quote('%'.$v.'%');
            $sql .= ' OR `thirdName` LIKE '.$this->_db->quote('%'.$v.'%');
            $sql .= ' OR `phone` LIKE '.$this->_db->quote('%'.$v.'%');
            if( $k+1 < $expCount )
            {
                $sql .= ') AND (';
            }
            else
            {
                $sql .= ')';
            }
        }
//        var_dump($sql);exit;
        return $this->_db->fetchAll($sql);
    }
    
    public function clearGuest()
    {
        $sql = 'UPDATE `guest` SET `inside`=0, `insideSort`= 0, `inTable` = 0';
        $this->_db->query($sql);
    }        
    
    public function toTable($guestId, $tableId)
    {
        $sql = 'UPDATE `guest` SET `inTable`= '.(int)$tableId.' WHERE `guestId` = '.(int)$guestId;
        $this->_db->query($sql);
    }  
    
    public function deleteFromTable($tableId)
    {
        $sql = 'UPDATE `guest` SET `inTable`= 0 WHERE `inTable` = '.(int)$tableId;
        $this->_db->query($sql);
    }   
    
    public function addPoints($points, $tableId)
    {
        $sql = 'UPDATE `guest` SET `points`=`points` + '.(int)$points.' WHERE `inside`=1 AND `inTable` = '.(int)$tableId;
        $this->_db->query($sql);
    }     
    
    public function removeGuestPoints($points, $guestId)
    {
        $sql = 'UPDATE `guest` SET `points`=`points` - '.(int)$points.' WHERE `guestId` = '.(int)$guestId;
        $this->_db->query($sql);
    }         
    
    public function addPointsLog($points, $tableId, $guestList)
    {
        $type = 'cash';
        if( $tableId != 0 )
            $type = 'table';
        
        for( $i=0; $i<count($guestList['data']); $i++ )
        {
            $sql = 'INSERT INTO `guestpoints` (`guestId`, `guestTableId`, `type`, `points`, `dateAdded`, `description`) '
                    . 'VALUES ('.(int)$guestList['data'][$i]['guestId'].', '.(int)$tableId.', '.$this->_db->quote($type).','.(int)$points.', '.$this->_db->quote(date('Y-m-d H:i:s')).', "")';
            $this->_db->query($sql);  
        }
    }   
    
    public function addGuestPointsLog($points, $guestTableId, $guestId, $type)
    {
//        if( $type == 'fortable' )
//        {
//            $points = '-'.$points;
//        }
        
        $sql = 'INSERT INTO `guestpoints` (`guestId`, `guestTableId`, `type`, `points`, `dateAdded`, `description`) '
                . 'VALUES ('.(int)$guestId.', '.(int)$guestTableId.', '.$this->_db->quote($type).','.(int)$points.', '.$this->_db->quote(date('Y-m-d H:i:s')).', "")';
        $this->_db->query($sql);  
    }       
    
    public function getBdayGuest()
    {
        $curDate = date('d.m');
        
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `birthday`  LIKE '.$this->_db->quote('%'.$curDate.'%').'
                    AND `deleted` = 0 AND `approved`=1';
        return $this->_db->fetchAll($sql);
    }        
    
    public function checkEmpty()
    {
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `name` = ""';
        $res = $this->_db->fetchRow($sql);
        
        if( empty($res) )
            return false;
        else
            return true;
    }      
    
    public function checkForNew($tableId)
    {
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `inside` = 1 AND `inTable` = '.(int)$tableId.'
                    AND `dateAdded` > '.$this->_db->quote(date('Y-m-d H:i:s', strtotime('-1 hours')));
        $res = $this->_db->fetchRow($sql);
        
        $sql2 = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `inside` = 1 AND `inTable` = '.(int)$tableId.'
                    AND `dateAdded` < '.$this->_db->quote(date('Y-m-d H:i:s', strtotime('-1 hours')));
        $res2 = $this->_db->fetchRow($sql2);        
        
        if( empty($res) || empty($res2) )
        {
            return false;
        }
        else
        {
            return true;
        }
    }        
    
    public function checkBdayGuests($tableId)
    {
        $checkRes = FALSE;
        $curDate = date('d.m');
        $yestDate = date('d.m', strtotime('-1 days'));
        $yestYestDate = date('d.m', strtotime('-2 days'));
        $curYear = date('Y');
        
//        var_dump($yestYestDate.' '.$yestDate.' '.$curDate);exit;
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `inside` = 1 AND `inTable` = '.(int)$tableId.''
                . ' AND (`birthday`  LIKE '.$this->_db->quote('%'.$curDate.'%').' '
                . '         OR `birthday`  LIKE '.$this->_db->quote('%'.$yestDate.'%').' '
                . '         OR `birthday`  LIKE '.$this->_db->quote('%'.$yestYestDate.'%').')';
        $gRes = $this->_db->fetchAll($sql);
        
        for( $i=0; $i < count($gRes); $i++ )
        {
            $sql2 = 'SELECT *
                        FROM `guestpoints` gp
                    LEFT JOIN `guesttableproduct` gtp ON gtp.guestTableId = gp.guestTableId
                    WHERE gtp.guestProductId = 39 AND gp.guestId = '.(int)$gRes[$i]['guestId'].''
                    . ' AND (gp.dateAdded  LIKE '.$this->_db->quote('%'.$curDate.$curYear.'%').' '
                    . '         OR gp.dateAdded  LIKE '.$this->_db->quote('%'.$yestDate.$curYear.'%').' '
                    . '         OR gp.dateAdded  LIKE '.$this->_db->quote('%'.$yestYestDate.$curYear.'%').')';                    
            $data = $this->_db->fetchAll($sql2);   
//        if( $_SESSION['user']['userId'] == 3 )
//        {
//            var_dump($sql2);exit;
//        }            
            if( empty($data) )
            {
                $checkRes = TRUE;
            }
        }
        return $checkRes;
    }     
    
    public function getBdayGuests($tableId)
    {
        $curDate = date('d.m');
        $yestDate = date('d.m', strtotime('-1 days'));
        $yestYestDate = date('d.m', strtotime('-2 days'));
        $curYear = date('Y');
        
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `deleted` = 0 AND `inside` = 1 AND `inTable` = '.(int)$tableId.''
                .  ' AND `bdYearUsed` < '.(int)$curYear.''
                . ' AND (`birthday`  LIKE '.$this->_db->quote('%'.$curDate.'%').' '
                . '         OR `birthday`  LIKE '.$this->_db->quote('%'.$yestDate.'%').' '
                . '         OR `birthday`  LIKE '.$this->_db->quote('%'.$yestYestDate.'%').')';
        $gRes = $this->_db->fetchAll($sql);
        return $gRes;
    }         
    
    public function removeRemark($guestId)
    {
        $sql = 'UPDATE `guest` SET `remark`="" WHERE `guestId` = '.(int)$guestId;
        $this->_db->query($sql);
    }   
    
    public function setUsedBDHookah($guestId)
    {
        $sql = 'UPDATE `guest` SET `bdYearUsed`='.(int)date('Y').' WHERE `guestId` = '.(int)$guestId;
        $this->_db->query($sql);
    }       
    
    public function deleteTablePoints($tableId)
    {
        $sql = 'SELECT *
                    FROM `guestpoints` 
                WHERE `type` = "table" AND `guestTableId` = '.(int)$tableId;
        $res = $this->_db->fetchAll($sql);
        
        for( $i=0; $i<count($res); $i++ )
        {
            $this->removeGuestPoints($res[$i]['points'], $res[$i]['guestId']);
        }
        
        $sql2 = 'DELETE FROM `guestpoints` '
                . 'WHERE `type` = "table" AND `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql2);     
    }       
    
    public function cancelCheck($tableId)
    {
        $sql = 'UPDATE `guesttable` SET `isCheck`=0 WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql);
    }        
    
    public function getInsideGuests()
    {
        $sql = 'SELECT g.*, gt.title
                    FROM `guest` g
                LEFT JOIN `guesttable` gt ON gt.guestTableId = g.inTable
                WHERE g.inside = 1 AND g.approved = 1 AND g.deleted = 0
                  ORDER by g.insideSort ASC';
        return $this->_db->fetchAll($sql);
    }      
}
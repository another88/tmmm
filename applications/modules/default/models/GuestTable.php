<?php
class GuestTable extends MetaModelBase
{
    public $tableName='guesttable';
    
    public function checkUniq($tableNum)
    {
        $sql = 'SELECT *
                    FROM `guesttable` 
                WHERE `deleted` = 0 AND `isOpen` = 1
                    AND `title` = '.$this->_db->quote($tableNum);
        $res = $this->_db->fetchRow($sql);
        
        if( empty($res) )
            return true;
        else
            return false;
    }      
    
    public function clearTable($dayId)
    {
        $sql = 'UPDATE `guesttable` SET `isOpen`=0';
        if( $dayId != 0 )
        {
            $sql .= ' WHERE `guestDayId` = '.(int)$dayId;
        }
        $this->_db->query($sql);
    }       
    
    public function checkOpensTable()
    {
        $sql = 'SELECT *
                    FROM `guesttable` 
                WHERE `deleted` = 0 AND `isOpen` = 1 AND `isAdmin` = 0';
        $res = $this->_db->fetchRow($sql);
        
        if( empty($res) )
            return false;
        else
            return true;
    }        
    
    public function addProduct($tableId, $productId, $amount)
    {
        $sql = 'SELECT *
                    FROM `guesttableproduct` 
                WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
        $res = $this->_db->fetchRow($sql);

        if( empty($res) )
        {
            $sql = 'INSERT INTO `guesttableproduct` (`guestTableId`, `guestProductId`, `amount`, `totalPrice`) VALUES ('.(int)$tableId.', '.(int)$productId.', '.(float)$amount.', 0)';
            $this->_db->query($sql);            
        }
        else
        {
            $sql = 'UPDATE `guesttableproduct` SET `amount`=`amount`+'.(float)$amount.' WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
            $this->_db->query($sql);            
        }
    } 
    
    public function getTableProducts($tableId)
    {
        $sql = 'SELECT gp.*, gtp.amount, gtp.totalPrice
                    FROM `guesttableproduct` gtp
                LEFT JOIN `guestproduct` gp ON gtp.guestProductId = gp.guestProductId
                WHERE gp.deleted = 0
                    AND gtp.guestTableId = '.(int)$tableId;   
        $data = $this->_db->fetchAll($sql);

        return $data;
    }      
    
    public function changeAmount($tableId, $productId, $amount)
    {
        $sql = 'UPDATE `guesttableproduct` SET `amount`='.$this->_db->quote($amount).' WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
        $this->_db->query($sql);            
    } 
    
    public function updatePrice($tableId, $productId, $price)
    {
        $sql = 'UPDATE `guesttableproduct` SET `totalPrice`='.(int)$price.' WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
        $this->_db->query($sql);            
    }     
    
    public function getTableGuests($tableId)
    {

        $sql = 'SELECT g.*
                    FROM `guest` g
                LEFT JOIN `guestpoints` gp ON g.guestId = gp.guestId
                WHERE gp.guestTableId = '.(int)$tableId.''
                . ' GROUP BY g.guestId';   
        $data = $this->_db->fetchAll($sql);

        return $data;
    }        
    
    public function deleteProduct($tableId, $productId, $amount=1)
    {
        $sql = 'SELECT *
                    FROM `guesttableproduct` 
                WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
        $res = $this->_db->fetchRow($sql);
        
        if( !empty($res) )
        {
            if( $res['amount'] > $amount )
            {
                $sql = 'UPDATE `guesttableproduct` SET `amount`=`amount`-'.(float)$amount.' WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
                $this->_db->query($sql);           
            }
            else
            {
                $sql = 'DELETE FROM `guesttableproduct` WHERE `guestTableId` = '.(int)$tableId.' AND `guestProductId` = '.(int)$productId;
                $this->_db->query($sql);            
            }         
        }
    }       
    
    public function getOpenTableRepalce($tableId, $type)
    {

        $sql = 'SELECT *
                    FROM `guesttable`
                WHERE `deleted` = 0
                    AND `isOpen` = 1
                    AND `isCheck` = 0
                    AND `guestTableId` != '.(int)$tableId;   
        if( $type == 'guest' )
        {
            $sql .= ' AND `isAdmin` = 0';
        }
        $data = $this->_db->fetchAll($sql);

        return $data;
    }        
    
    public function replaceProduct($tableId, $oldTableId, $productId, $amount)
    {
        $this->deleteProduct($oldTableId, $productId, $amount);
        $this->addProduct($tableId, $productId, $amount);
    }       
    
    public function replaceGuest($tableId, $oldTableId, $guestId)
    {
        $sql = 'SELECT *
                    FROM `guest` 
                WHERE `inside` = 1 AND `guestId` = '.(int)$guestId.' AND `inTable` = '.(int)$oldTableId;
        $res = $this->_db->fetchRow($sql);
        
        if( !empty($res) )
        {
            $sql = 'UPDATE `guest` SET `inTable`='.(int)$tableId.' WHERE `guestId` = '.(int)$guestId;
            $this->_db->query($sql);           
        }
    }         
    
    public function setCheck($tableId)
    {
        $sql = 'UPDATE `guesttable` SET `isCheck`=1';
        $sql .= ' WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql);
    }      
    
    public function deletePointsSale($tableId)
    {
        $sql = 'UPDATE `guesttable` SET `pointSale`=0';
        $sql .= ' WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql);
        
        $sql2 = 'DELETE from `guestpoints`';
        $sql2 .= ' WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql2);        
    }          
    
    public function addPointsSale($tableId, $points)
    {
        $sql = 'UPDATE `guesttable` SET `pointSale`='.(int)$points;
        $sql .= ' WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql);
    }     
    
    public function getPointSaleGuest($tableId)
    {

        $sql = 'SELECT g.*, gp.points
                    FROM `guest` g
                LEFT JOIN `guestpoints` gp ON g.guestId = gp.guestId
                    WHERE gp.type = \'fortable\' AND gp.guestTableId = '.(int)$tableId;   
        $data = $this->_db->fetchAll($sql);

//        var_dump($sql);exit;
        
        return $data;
    }      
    
    public function saveRemark($tableId, $remark)
    {
        $sql = 'UPDATE `guesttable` SET `remark`='.$this->_db->quote($remark).' WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql);            
    }        
    
    public function checkTableHookah($tableId)
    {
        $sql = 'SELECT gp.guestProductId
                    FROM `guesttableproduct` gtp
                LEFT JOIN `guestproduct` gp ON gtp.guestProductId = gp.guestProductId
                    WHERE gp.approved = 1 AND gp.deleted = 0 AND gp.guestProductCategoryId = 1 AND gtp.guestTableId = '.(int)$tableId;   
        $res = $this->_db->fetchAll($sql);
        
        if( empty($res) )
            return false;
        else
            return true;
    }       
    
    public function checkTableTitle($tableId, $title)
    {
        $sql = 'SELECT *
                    FROM `guesttable` 
                WHERE `deleted` = 0 AND `isOpen` = 1 AND `guestTableId` != '.(int)$tableId.'
                    AND `title` = '.$this->_db->quote($title);
        $res = $this->_db->fetchRow($sql);
        
        if( !empty($res) )
            return true;
        else
            return false;
    }     
    
    public function changeTableTitle($tableId, $title)
    {
        $sql = 'UPDATE `guesttable` SET `title`='.$this->_db->quote($title).' WHERE `guestTableId` = '.(int)$tableId;
        $this->_db->query($sql);            
    }      
}
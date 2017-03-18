<?php
class Mix extends MetaModelBase
{
    public $tableName='mix';  
    
    public function addTabacToMix($mixId, $tabacId, $tabacCategoryId, $percent)
    {
        $sql = 'INSERT INTO `tabacmix` '
                . '(`tabacId`, `tabacCategoryId`, `mixId`, `percent`) VALUES '
                . '('.(int)$tabacId.', '.(int)$tabacCategoryId.', '.(int)$mixId.', '.(int)$percent.')';
        $this->_db->query($sql);
    }

    public function searchMix($searchData, $onlySelected)
    {
        $data = array();
        if( $onlySelected == 0 )
        {
            // ПОИСК ЕСТЬ ЕСТЬ ХОТЬ ОДИН ВКУС
//            $tabacIdList = '';
//            for( $j=0; $j<count($searchData['selectedTabacList']); $j++ )
//            {
//                $tabacIdList .= $searchData['selectedTabacList'][$j];
//                if( $j+1 < count($searchData['selectedTabacList']) )
//                {
//                    $tabacIdList .= ', ';
//                }
//            }
//            $sql = 'SELECT m.*
//                        FROM `tabacmix` tm
//                    LEFT JOIN `mix` m ON m.mixId = tm.mixId
//                    WHERE m.deleted = 0
//                        AND m.approved = 1
//                        AND tm.tabacId IN ('.$tabacIdList.')'
//                    . ' GROUP by mixId'
//                    . ' ORDER by mixId DESC';            
//            $data = $this->_db->fetchAll($sql);

            $sql = 'SELECT m.*
                        FROM `tabacmix` tm
                    LEFT JOIN `mix` m ON m.mixId = tm.mixId
                    WHERE m.deleted = 0
                        AND m.approved = 1';
            $sql .= ' AND tm.tabacId = '.(int)$searchData['selectedTabacList'][0];
            $sql .= ' GROUP by mixId ORDER by mixId DESC';   
            $dataFirst = $this->_db->fetchAll($sql);   
            
            for( $df=0; $df<count($dataFirst); $df++ )
            {
                $sqlTabac = 'SELECT tabacId
                            FROM `tabacmix`
                        WHERE mixId = '.(int)$dataFirst[$df]['mixId'];
                $tabacRes = $this->_db->fetchAll($sqlTabac);   
                $tabacCheck = TRUE;
                
                $tabacRes2 = array();
                for( $t=0; $t<count($tabacRes); $t++ )
                {
                    $tabacRes2[] = $tabacRes[$t]['tabacId'];
                }                
                
                for( $j=0; $j<count($searchData['selectedTabacList']); $j++ )
                {
                    if( !in_array($searchData['selectedTabacList'][$j], $tabacRes2) )
                    {
                        $tabacCheck = FALSE;
                        continue;
                    }
                }                
                if( $tabacCheck )
                {
                    $data[] = $dataFirst[$df];
                }
            }    
        }
        else
        {
            $sql = 'SELECT m.*
                        FROM `tabacmix` tm
                    LEFT JOIN `mix` m ON m.mixId = tm.mixId
                    WHERE m.deleted = 0
                        AND m.approved = 1';
            $sql .= ' AND tm.tabacId = '.(int)$searchData['selectedTabacList'][0];
            $sql .= ' GROUP by mixId ORDER by mixId DESC';   
            $dataFirst = $this->_db->fetchAll($sql);   
            
            for( $df=0; $df<count($dataFirst); $df++ )
            {
                $sqlTabac = 'SELECT tabacId
                            FROM `tabacmix`
                        WHERE mixId = '.(int)$dataFirst[$df]['mixId'];
                $tabacRes = $this->_db->fetchAll($sqlTabac);    
                if( count($tabacRes) <= count($searchData['selectedTabacList']) )
                {
                    $tabacCheck = TRUE;
                    for( $t=0; $t<count($tabacRes); $t++ )
                    {
                        if( !in_array($tabacRes[$t]['tabacId'], $searchData['selectedTabacList']) )
                        {
                            $tabacCheck = FALSE;
                            continue;
                        }
                    }
                    if( $tabacCheck )
                    {
                        $data[] = $dataFirst[$df];
                    }                    
                }
            }
        }
        
        for( $i=0; $i<count($data); $i++ )
        {
            $sqlDet = 'SELECT tm.*, tc.title as tabacCategoryTitle, t.title as tabacTitle, t.colorCode as color,
                                tm.percent as value, t.title as label
                        FROM `tabacmix` tm
                    LEFT JOIN `mix` m ON m.mixId = tm.mixId
                    LEFT JOIN `tabaccategory` tc ON tc.tabacCategoryId = tm.tabacCategoryId
                    LEFT JOIN `tabac` t ON t.tabacId = tm.tabacId
                    WHERE m.deleted = 0
                        AND m.approved = 1
                        AND tc.deleted = 0
                        AND tc.approved = 1
                        AND t.deleted = 0
                        AND t.approved = 1
                        AND tm.mixId = '.(int)$data[$i]['mixId'].'';   
            $data[$i]['mixDetails'] = $this->_db->fetchAll($sqlDet);
        }
//        var_dump($data);exit;
        return $data;
    }         
    
    public function checkMix($mixCode)
    {
        $sql = 'SELECT *
                    FROM `mix`
                    WHERE `deleted` = 0
                        AND `mixCode` = '.$this->_db->quote($mixCode);
        $res = $this->_db->fetchRow($sql);
        if( empty($res) )
            return true;
        else
            return false;
    }  
    
    public function getMix($mid)
    {
        $mixData = array();
        $sql = 'SELECT *
                    FROM `mix`
                    WHERE `deleted` = 0
                        AND `mixId` = '.(int)$mid;
        $mixData = $this->_db->fetchRow($sql);        
        
        $sqlDet = 'SELECT tm.*, tc.title as tabacCategoryTitle, t.title as tabacTitle, t.colorCode as color,
                            tm.percent as value, t.title as label
                    FROM `tabacmix` tm
                LEFT JOIN `mix` m ON m.mixId = tm.mixId
                LEFT JOIN `tabaccategory` tc ON tc.tabacCategoryId = tm.tabacCategoryId
                LEFT JOIN `tabac` t ON t.tabacId = tm.tabacId
                WHERE m.deleted = 0
                    AND m.approved = 1
                    AND tc.deleted = 0
                    AND tc.approved = 1
                    AND t.deleted = 0
                    AND t.approved = 1
                    AND tm.mixId = '.(int)$mid;   
        $mixData['mixDetails'] = $this->_db->fetchAll($sqlDet);
        return $mixData;
    }      
    
    public function setAsSaved($mixId)
    {
        $sql = 'UPDATE `mix` SET `saved`=1 WHERE `mixId` = '.(int)$mixId;
        $this->_db->query($sql);
    }    
}

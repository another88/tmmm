<?php
class TabacCategory extends MetaModelBase
{
    public $tableName='tabaccategory';  
    
    public function getUsedCategory()
    {
        $sql = 'SELECT tc.*
                    FROM `tabacmix` tm
                    LEFT JOIN `tabaccategory` tc ON tc.tabacCategoryId = tm.tabacCategoryId
                    WHERE tc.deleted = 0
                        AND tc.approved = 1
                    GROUP by tc.tabacCategoryId
                    ORDER by tc.title ASC';
        return $this->_db->fetchAll($sql);
    }    
}

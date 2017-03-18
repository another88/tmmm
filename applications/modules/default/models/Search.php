<?php

class Search extends MetaModelBase
{
    public function searchFunc($searchKey)
    {
        $sql = 'SELECT * 
                FROM `product`
                WHERE deleted = 0 
                    AND approved = 1
                    AND MATCH( title, 
                        shortDescription, 
                        description ) 
                AGAINST( '.$this->_db->quote($searchKey).' IN BOOLEAN MODE)';
        return $this->_db->fetchAll($sql);
    }
    
//    public function searchFunc($searchKey)
//    {
//        $sql = 'SELECT * FROM ( '.
//        ' ( 
//        SELECT
//            p.productId as productId,
//            p.title as productTitle,
//            p.productCategoryId as productProductCategoryId,
//            p.shortDescription as productShortDescription,
//            p.price as productPrice,
//            p.imageMedium as productImageMedium,
//            "" as productCategoryId,
//            "" as categoryTitle,
//            "" as categoryShortDescription,
//            "" as categoryImageMedium,
//            "" as specialId,
//            "" as specialTitle,
//            "" as specialUrl,
//            "" as specialDescription,
//            "" as specialImageMedium,
//            "" as contentId,
//            "" as contentTitle,
//            "" as contentDescription,
//            1 as orderNumber
//        FROM product p
//        WHERE p.deleted = 0 
//            AND p.approved = 1 
//            AND MATCH( p.title, 
//                        p.shortDescription, 
//                        p.description ) 
//                AGAINST( '.$this->_db->quote($searchKey).' IN BOOLEAN MODE)
//            ';
//        $sql.=')';
//  
//        $sql .= ' UNION '.
//        ' ( 
//        SELECT
//            "" as productId,
//            "" as productTitle,
//            "" as productProductCategoryId,
//            "" as productShortDescription,
//            "" as productPrice,
//            "" as productImageMedium,
//            pc.productCategoryId as productCategoryId,
//            pc.title as categoryTitle,
//            pc.shortDescription as categoryShortDescription,
//            pc.imageMedium as categoryImageMedium,
//            "" as specialId,
//            "" as specialTitle,
//            "" as specialUrl,
//            "" as specialDescription,
//            "" as specialImageMedium,
//            "" as contentId,
//            "" as contentTitle,
//            "" as contentDescription,
//            2 as orderNumber                   
//        FROM productcategory pc
//        WHERE pc.deleted = 0 
//            AND pc.approved = 1 
//            AND MATCH( pc.title, 
//                        pc.shortDescription, 
//                        pc.description ) 
//                AGAINST( '.$this->_db->quote($searchKey).' IN BOOLEAN MODE)
//            ';
//        $sql.=')';   
//        
//        $sql .= ' UNION '.
//        ' ( 
//        SELECT
//            "" as productId,
//            "" as productTitle,
//            "" as productProductCategoryId,
//            "" as productShortDescription,
//            "" as productPrice,
//            "" as productImageMedium,
//            "" as productCategoryId,
//            "" as categoryTitle,
//            "" as categoryShortDescription,
//            "" as categoryImageMedium,
//            s.specialId as specialId,
//            s.title as specialTitle,
//            s.url as specialUrl,
//            s.description as specialDescription,
//            s.imageMedium as specialImageMedium,
//            "" as contentId,
//            "" as contentTitle,
//            "" as contentDescription,
//            3 as orderNumber                    
//        FROM special s
//        WHERE s.deleted = 0 
//            AND s.approved = 1 
//            AND MATCH( s.title, s.description ) 
//                AGAINST( '.$this->_db->quote($searchKey).' IN BOOLEAN MODE)
//            ';
//        $sql.=')';   
//        
//        $sql .= ' UNION '.
//        ' ( 
//        SELECT
//            "" as productId,
//            "" as productTitle,
//            "" as productProductCategoryId,
//            "" as productShortDescription,
//            "" as productPrice,
//            "" as productImageMedium,
//            "" as productCategoryId,
//            "" as categoryTitle,
//            "" as categoryShortDescription,
//            "" as categoryImageMedium,
//            "" as specialId,
//            "" as specialTitle,
//            "" as specialUrl,
//            "" as specialDescription,
//            "" as specialImageMedium,
//            c.contentId as contentId,
//            c.title as contentTitle,
//            c.description as contentDescription,
//            4 as orderNumber
//        FROM content c
//        WHERE c.deleted = 0 
//            AND MATCH( c.title, c.description ) 
//                AGAINST( '.$this->_db->quote($searchKey).' IN BOOLEAN MODE)
//            ';
//        $sql.=')';           
//        
//        $sql .= ' ) as results ORDER by orderNumber ASC';
//        return $this->_db->fetchAll($sql);
//    }
}

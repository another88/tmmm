<?php

class Admin_PermissionsController extends BaseController 
{
    public function init() {
        parent::init();
        $this->_view->menuOpen = 'user';
    }
    
    public function indexAction() {
        $this->_view->title = 'Permission groups';
        $this->_view->groups = $this->PermissionGroup->listing();
        $this->_smarty->display('permissions/index.tpl');
    }

    public function detailAction() {
        $id = (int) $this->_request->getParam('pg');
        if(empty($id) || !intval($id))
            exit('Id error');
        $this->_view->details = $this->PermissionGroup->details($id);
        $this->_view->title = 'Details of group "'.$this->_view->details['title'].'"';
        $this->_view->objects = $this->PermissionObject->getGroupObject($id);
        $this->_view->users = $this->PermissionGroupUser->getUsers($id);
        $this->_view->userAvailable = $this->PermissionGroupUser->getAvailable($id);
        $this->_smarty->display('permissions/detail.tpl');
    }
    
    public function activateAction()
    {
        $pg = $this->_request->getParam('pg');
        $po = $this->_request->getParam('po');
        if(empty($pg) || !intval($pg) || empty($po) || !intval($po))
            exit('Id error');
        $this->PermissionGroupObject->add(array('permission_groupId'=>$pg, 'permission_objectId'=>$po));
        parent::redirect('admin/permissions/detail/pg/'.$pg);
    }
    
    public function deactivateAction()
    {
        $pg = $this->_request->getParam('pg');
        $po = $this->_request->getParam('po');
        if(empty($pg) || !intval($pg) || empty($po) || !intval($po))
            exit('Id error');
        $this->PermissionGroupObject->delete($pg, $po);
        parent::redirect('admin/permissions/detail/pg/'.$pg);
    }
    
    public function addgroupAction()
    {
        $id = $this->_request->getParam('id');
        if($this->_request->isPost()) {
            $data = $this->_request->getPost();
            if(!$this->PermissionGroup->metaValidate($data))
                parent::redirect ('admin/permissions/addgroup/id/'.$id);
            $this->PermissionGroup->unsetFormData();
            if(!empty($id)) {
                $this->PermissionGroup->save($data, $id);
                $_SESSION['notice'] = 'Group update!';
                parent::redirect('admin/permissions');
            } else {
                $lastId = $this->PermissionGroup->add($data);
                $_SESSION['notice'] = 'The group added! Enter the law.';
                parent::redirect('admin/permissions/detail/pg/'.$lastId);
            }
        }
        if(!empty ($id))
            $this->PermissionGroup->setFormData($this->PermissionGroup->details($id));
        
        $this->_view->html = $this->PermissionGroup->createHTML('admin/permissions/addgroup/id/'.$id);
        $this->_smarty->display('default.tpl');
        $this->PermissionGroup->unsetFormData();
        
    }
    
    public function deletegroupAction()
    {
        $pg = $this->_request->getParam('pg');
        if(empty($pg) || !intval($pg))
            exit('Id error');
        $this->PermissionGroup->delete($pg);
        $_SESSION['notice'] = 'Group has been deleted with all relations!';
        parent::redirect('admin/permissions');
    }
    
    public function addobjectAction()
    {
        $id = $this->_request->getParam('id');
        if($this->_request->isPost()) {
            $data = $this->_request->getPost();
            if(!$this->PermissionObject->metaValidate($data))
                parent::redirect ('admin/permissions/addobject/id/'.$id);
            $check = $this->PermissionObject->listing(0, 1, array('code'=>$data['code']));
            if(count($check['data'])>0) {
                $_SESSION['error'] = 'Object with name already exists!';
                parent::redirect ('admin/permissions/addobject/id/'.$id);
            }
                
            $this->PermissionObject->unsetFormData();
            if(!empty($id)) {
                $this->PermissionObject->save($data, $id);
                $_SESSION['notice'] = 'The object is added!';
                parent::redirect('admin/permissions');
            } else {
                $lastId = $this->PermissionObject->add($data);
                $_SESSION['notice'] = 'WARNING! The object has been updated! You may need to edit the configuration file access.';
                parent::redirect('admin/permissions');
            }
        }
        if(!empty ($id))
            $this->PermissionObject->setFormData($this->PermissionObject->details($id));
        
        $this->_view->html = $this->PermissionObject->createHTML('admin/permissions/addobject/id/'.$id);
        $this->_smarty->display('default.tpl');
        $this->PermissionObject->unsetFormData();
    }
    
    public function deleteobjectAction()
    {
        $id = $this->_request->getParam('id');
        if(empty($id) || !intval($id))
            exit('Id error');
        $this->PermissionObject->delete($id);
        $_SESSION['notice'] = 'WARNING! The object has been deleted! You may need to edit the configuration file access.';
        parent::redirect('admin/permissions');
    }
    
    public function deleteuserAction()
    {
        $id = $this->_request->getParam('id');
        $pg = $this->_request->getParam('pg');
        if(empty($pg) || !intval($pg) || empty($id) || !intval($id))
            exit('Id error');
        $this->PermissionGroupUser->delete($id);
        $_SESSION['notice'] = 'User is excluded from this group!';
        parent::redirect('admin/permissions/detail/pg/'.$pg);
    }
    
    public function adduserAction()
    {
        $pg = $this->_request->getParam('pg');
        $userId = $this->_request->getParam('userId');
        if(empty($pg) || !intval($pg) || empty($userId) || !intval($userId))
            exit('Id error');
        $this->PermissionGroupUser->add(array(
                                                'userId'=>$userId, 
                                                'permission_groupId'=>$pg,
                                                'dateAdded'=>date('Y-m-d H:i:s')));
        $_SESSION['notice'] = 'Has been added to the group!';
        parent::redirect('admin/permissions/detail/pg/'.$pg);
    }
    
    public function setAction()
    {
        $userId = $this->_request->getParam('id');
        if(empty($userId) || !intval($userId))
            exit('Id error');
        $this->_view->userId = $userId;
        $this->_view->groups = $this->PermissionGroupUser->getGroups($userId);
        $this->_view->groupsAvailable = $this->PermissionGroupUser->getAvailableGroups($userId);
        $this->_view->title = 'Группы Доступа Пользователя';
        $this->_smarty->display('permissions/set.tpl');
    }
    
    public function addgrouptouserAction()
    {
        $userId = $this->_request->getParam('id');
        $pg = $this->_request->getParam('permission_groupId');
        if(empty($pg) || !intval($pg) || empty($userId) || !intval($userId))
            exit('Id error');
        $this->PermissionGroupUser->add(array(
                                                'userId'=>$userId, 
                                                'permission_groupId'=>$pg,
                                                'dateAdded'=>date('Y-m-d H:i:s')));
        $_SESSION['notice'] = 'The group is added to the user!';
        parent::redirect('admin/permissions/set/id/'.$userId);
    }
    
    public function deletegroupfromuserAction()
    {
        $id = $this->_request->getParam('pg');
        $userId = $this->_request->getParam('uid');
        if(empty($id) || !intval($id) || empty($userId) || !intval($userId))
            exit('Id error');
        $this->PermissionGroupUser->delete($id);
        $_SESSION['notice'] = 'Group deleted!';
        parent::redirect('admin/permissions/set/id/'.$userId);
    }
}
?>

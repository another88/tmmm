<?php


class Admin_PermissionController extends AdminController
{
    public function init()
    {
        parent::init();
        $this->_view->menuOpen = 'user';
    }
    
    public function setAction()
    {
        $id = $this->_request->getParam('id'); //userId
        if(empty($id) || !intval($id))
            parent::redirect ('');
        if($this->_request->isPost()) {
            $data = $this->_request->getPost();
            $this->PermissionUser->clearPermission($id);
            if(count($data['permissionRuleId'])>0)
                $this->PermissionUser->insert($data['permissionRuleId'], $id);
            $_SESSION['notice'] = 'Permissions has been updated!';
            parent::redirect('admin/user');
        }
        $this->_view->userId = $id;
        $this->_view->rule = $this->PermissionRule->listing(0, 1, array('order'=>' ORDER BY title ASC'));
        $this->_view->userPermission = $this->PermissionUser->listing(0, 1, array('userId'=>$id));
        $this->_view->title = 'Permissions';
        $this->_smarty->display('permission/set.tpl');
    }
}
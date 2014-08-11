<?php

class CategoriesController extends Zend_Controller_Action
{

  public function init()  {

    $this->cat = new Application_Model_DbTable_Category();
    $this->_helper->layout()->setLayout('bootstrap');
    if (!Zend_Auth::getInstance()->hasIdentity()) {
      $this->_redirect('user/login');
      exit;
    }

  }

  function indexAction()
  {
    echo "<h4>Site is under construction...</h4>";
    exit;
   // $this->view->msg = "My first action";
  }

  function addMainAction()
  {
    echo __METHOD__ . __FILE__ . __LINE__;
    if ($this->getRequest()->isPost()) {
      $data = $this->getRequest()->getPost();
      $id = $this->cat->insert($data);
      $this->view->id = $id;
    } else {
      $cats = $this->cat->fetchAll("parent_id='0'");
      $this->view->cats = $cats;
    }
  }

  function addSubAction()
  {

    if ($this->getRequest()->isPost()) {
      $data = $this->getRequest()->getPost();

      $id = $this->cat->insert($data);
      $this->view->id = $id;
    }
    $cats = $this->cat->fetchAll("parent_id='0'");
    $this->view->cats = $cats;
    $pid = (int)$this->_getParam('pid', 1);

    $sub_cats = $this->cat->fetchAll("parent_id='$pid'");

    $this->view->sub_cats = $sub_cats;
    $this->view->pid = $pid;

  }


  function ajaxGetSubCatAction()
  {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender();

    if ($this->getRequest()->isPost()) {
      $data = $this->getRequest()->getPost();
      $pid = (int)$data['id'];
      //$pid = 1;
      $sub_cats = $this->cat->fetchAll("parent_id='$pid'");
      $data = array();

      foreach($sub_cats as $key=>$value){
        $data[] = array(
                        'id'=>$value->id,
                        'parent_id'=>$value->parent_id,
                        'name'=>$value->name,
        );
      }
      echo json_encode($data);
    }// end if
  }

  function ajaxAddSubCatAction()
  {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender();

    if ($this->getRequest()->isPost()) {
      $data = $this->getRequest()->getPost();
      $id = $this->cat->insert($data);

      $resData[] = array(
                        'id'=>$id,
                        'parent_id'=>$data['parent_id'],
                        'name'=>$data['name'],
        );

      echo json_encode($resData);
    }// end if


  }// end ajaxGetSubCatAction

}

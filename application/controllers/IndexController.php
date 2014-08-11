<?php

class IndexController extends Zend_Controller_Action
{

  public function init()  {
//     echo "I am i const...";
    /* Initialize action controller here */


      $this->albums = new Application_Model_DbTable_Albums();


      $this->_helper->layout()->setLayout('bootstrap');
      if (!Zend_Auth::getInstance()->hasIdentity()) {
        $this->_redirect('user/login');
        exit;
      }
      $userInfo = Zend_Auth::getInstance()->getStorage()->read();
      $this->view->login = $userInfo ;

  }

  public function indexAction()
  {
    $str = file_get_contents('count.txt');
    $count = (int)$str + 1;
    file_put_contents('count.txt',$count);
  }

  public function usersAction()
  {

    $this->view->ratnesh = $this->albums->fetchAll();
  }

  public function addAction()
  {

    if ($this->getRequest()->isPost()) {

      //$arrInput = $this->_request->getPost();
       //print_r($arrInput);exit;
      $artist = $this->_request->getPost('artist');
      $title = $this->_request->getPost('title');

      $this->albums->addAlbum($artist, $title);


      $this->_helper->redirector('users');
    }
  }

  public function editAction()
  {
    //$this->_helper->layout->disableLayout();

    if ($this->getRequest()->isPost()) {

      $id = (int)$this->_request->getPost('id');
      $artist = $this->_request->getPost('artist');
      $title = $this->_request->getPost('title');
      $this->albums->updateAlbum($id, $artist, $title);
      $this->_helper->redirector('index');
    } else {
     $id = $this->_getParam('id', 0);

     $this->view->id = $id;
      $this->view->album = $this->albums->getAlbum($id);
    }
  }

  public function deleteAction()
  {




    if ($this->getRequest()->isPost()) {
      $del = $this->getRequest()->getPost('del');
      if ($del == 'Yes') {
        $id = $this->getRequest()->getPost('id');
        $this->albums->deleteAlbum($id);
      }
      $this->_helper->redirector('index');
    } else {
      $id = $this->_getParam('id', 0);
      $this->view->album = $this->albums->getAlbum($id);

    }
  }


  public function ajaxTestAction()
  {
    $this->_helper->layout->disableLayout();
    $this->_helper->viewRenderer->setNoRender();
sleep(3);
   $countries =  array(
      "in"=>"India",
      "pk"=>"pakistan",
      "np"=>"Nepal",
      "ch"=>"China",
      "bn"=>"BanglaDesh",
      "sl"=>"SriLanka",
      "bh"=>"Bhutan",
      "af"=>"Afganistan",
      "my"=>"Myanmar");
      echo json_encode($countries);

  }

  public function showCountryAction()
  {

  }

}








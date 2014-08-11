<?php

class UserController extends Zend_Controller_Action
{

  public function init()
  {
      /* Initialize action controller here */
    $this->mysession = new Zend_Session_Namespace('mysession');
    $this->_helper->layout()->setLayout('blank');
    $this->user = new Application_Model_DbTable_User();
  }

  public function successAction()
  {

  }


  public function confirmAction()
  {
         $id = $this->_getParam('id', 0);
         $id = (int)decrypt($id);
         $rowCount = $this->user->fetchAll("id='$id'")->count();
         if($rowCount != 1) {
            $this->_redirect('index/login');
         } else {
          $where = "id='$id'";
          $data = array('status'=>1);
          $this->user->update($data,$where);
         }
  }

  public function registerAction()
  {
    if (Zend_Auth::getInstance()->hasIdentity()) {
      $this->_redirect('index/index');
      exit;
    }

    if ($this->_request->isPost()) {

      $data = $this->_request->getPost();
      $data = array_map('trim',$data);
      $data = array_map('mysql_real_escape_string',$data);
      if(isset($data['email'])&&isset($data['password'])&&!empty($data['email'])&&!empty($data['password']))
      {
        $data['password'] = md5($data['password']);
        $data['added_date'] = date('Y-m-d H:i:s');
        $data['status'] = '0';
        $inserted_id = $this->user->insert($data);

        if($inserted_id){
          $this->sendVerifyMail($inserted_id,$data['email'], $data['name']);

          $this->_redirect('user/success');
        }
        var_dump($inserted_id);
      } else {
         $this->view->loginMessage = "Invalid username or password.";
      }
    }
  }

function createLink($inserted_id = 0) {
  var_dump($inserted_id);

  $id = encrypt($inserted_id);
  var_dump($id);
  return "<a href='".SITE_PATH."/user/confirm/id/$id'>$id</a>";
}

function sendVerifyMail($inserted_id,$email, $name ){

  $link =  $this->createLink($inserted_id);

  $message = <<<MSG

  Hello $name,
    Greetings !!
    Please click the link below
    $link
    Best wishes !!
    mysite.com team
MSG;
echo $message;exit;
  mail($email, "Please confirm register email id", $message);
}

  public function loginAction()
  {


    if (Zend_Auth::getInstance()->hasIdentity()) {
      $this->_redirect('index/index');
      exit;
    }

    if ($this->_request->isPost()) {

      $data=$this->_request->getPost();
      if(isset($data['email'])&&isset($data['password'])&&!empty($data['email'])&&!empty($data['password']))
      {
        // get the default db adapter
        $db = Zend_Db_Table::getDefaultAdapter();
        //create the auth adapter
        $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users','email', 'password');
        //set the username and password
        $authAdapter->setIdentity(addslashes(trim($data['email'])));
        $authAdapter->setCredential(md5(addslashes(trim($data['password']))));

        $select = $authAdapter->getDbSelect();
        $select->where("status = '1'");


        //authenticate
        $result = $authAdapter->authenticate();

        if ($result->isValid()) {

          $auth = Zend_Auth::getInstance();
          $storage = $auth->getStorage();
          $storage->write($authAdapter->getResultRowObject(array('email','added_date','name')));

          $authSession = new Zend_Session_Namespace('Zend_Auth');
          $authSession->setExpirationSeconds(60*10);

          $this->_redirect('Index/index');
          exit;
        } else {
          $this->view->loginMessage = "Sorry, your username or password is incorrect";
        }
      } else {
            $this->view->loginMessage = "Invalid username or password.";
      }
    }
  }

  public function logoutAction()
  {
    Zend_Auth::getInstance()->clearIdentity();
    $session = new Zend_Session_Namespace();
     $this->_redirect('user/login');
  }
}

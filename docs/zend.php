<?php
//  http://zend-framework-tutorial.googlecode.com/svn/trunk/


$request = $this->getRequest();

print_r($request->getPost());

print_r($request->getParams());
$arrInput = $this->_request->getParams();
$arrInput = $this->getRequest()->getParam('action');

print_r($request->getPost('username'));
print_r($request->getParam('action'));

echo $this->_request->getPost('username');


  // How To check Data is posted or not ?
  if($this->getRequest()->isPost()) {
  if($this->_request->isPost()) {

/*************************************************
 * FOR LOGIN
 **************************************************/

        // get the default db adapter
        $db = Zend_Db_Table::getDefaultAdapter();
        //create the auth adapter
        $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users',
            'username', 'password');
        //set the username and password
        $authAdapter->setIdentity($data['username']);
        $authAdapter->setCredential(md5($data['password']));
        //authenticate
        $result = $authAdapter->authenticate();
        if ($result->isValid()) {
            // store the username, first and last names of the user
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $storage->write($authAdapter->getResultRowObject(
                array('username' , 'first_name' , 'last_name', 'role')));
            return $this->_forward('index');
        } else {
            $this->view->loginMessage = "Sorry, your username or
                password was incorrect";
        }
/*********************************************************/

  /**
  * How to load model in controller
  **/
  Zend_Loader::loadClass('baseModel');
  $this->baseModel = new baseModel();


  /**
  * How to set layout in Zend
  **/

  $this->_helper->layout()->setLayout('login');// ?? why we need that ex

  $path = ROOT_PATH . '/public/theme/'. $theme . '/layouts';
  Zend_Layout::startMvc($path);


  /**
  * Way to Fetch Data from config.ini
  **/
  $config = Zend_Registry::get("config");
  $this->site=$config->url->url->site;


  /**
  * Zend Build In Validations
  * */
  if(!Zend_Validate::is($this->_post('username'),'NotEmpty')) {
    echo 'Username should not be empty';
  }


  /*
  * How to use flash messanger
  * */
  $this->_helper->flashMessenger->addMessage('Record Saved!', "Hello vikas");

  $this->_redirect('users/edit');

  $var = $this->_helper->flashMessenger->getMessages();


  /*
  * If in any function of controller we don't need view and don't want to render
  * */
  $this->_helper->layout->disableLayout();
  $this->_helper->viewRenderer->setNoRender();

  /*
  * Zend Json encode and decode
  **/
  $qnp = Zend_Json::decode($array);


$this->_request->getControllerName()
$this->_request->getActionName()
$this->session->setExpirationSeconds(3600);
date_default_timezone_get()
date_default_timezone_set()

/////////////// EMAIL VALIDATION ///////////////
$email1 = "nonsense.something@dottiness"; // not a valid email
echo $email1."</br>";
 $email2 = "dotty@something.whatever"; // valid email
 echo $email2."</br>";

 $clean_email1 = filter_var($email1, FILTER_VALIDATE_EMAIL); // $clean_email1 = false
 echo $clean_email1."</br>";
 $clean_email2 = filter_var($email2, FILTER_VALIDATE_EMAIL); // $clean_email2 = dotty@something.whatever
 echo $clean_email2."</br>";


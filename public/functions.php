<?php
//echo date_default_timezone_get();
date_default_timezone_set('Asia/Kolkata');

function pr($data){
  if ($_SERVER['HTTP_HOST'] == 'zf.local'){
    echo '<pre style="color:white;background:black;">';
    print_r($data);
    echo '</pre>';
  }
}


//$id = encrypt(12);
//echo decrypt($id);


  /*
   * File Contain two functions encrypt() and decrypt()
   * used to encode and decode strings with the help of user defined salt
   * */

  function encrypt($string='')
  {
    // This is 32 bit salt value change it
    $salt = '9iwjwj455aufj4669gkfmdfkl244h45t';

    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,
                                              md5($salt),
                                              $string,
                                              MCRYPT_MODE_CBC,
                                              md5(md5($salt))
                                             )
                              );
    return base64_encode($encrypted);
  }

  function decrypt($encrypted='')
  {
    $encrypted = base64_decode($encrypted);
    // This is 32 bit salt value change it
    $salt = '9iwjwj455aufj4669gkfmdfkl244h45t';

    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,
                                      md5($salt),
                                      base64_decode($encrypted),
                                      MCRYPT_MODE_CBC,
                                      md5(md5($salt))
                                      ),
                  "\0");
    return $decrypted;
  }









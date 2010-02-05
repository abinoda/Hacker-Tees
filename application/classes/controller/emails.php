<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Emails extends Controller_Application {

    public function action_new()
    {
        if ($_POST)
        {
            if (Validate::email($_POST['email']))
            {
                $email = ORM::factory('email')
                              ->where('email', '=', $_POST['email'])
                              ->find();
                          
                if ( ! $email->loaded())
                {
                    $email->email = $_POST['email'];
                    $email->save();
                }
                
                $response['success'] = TRUE;
            }
            else
            {
                $response['success'] = FALSE;
            }
        }
        else
        {
            throw new ReflectionException;
        }
    
        $this->request->headers['Content-Type'] = 'application/json';
        $this->request->response = json_encode($response);
    }
}
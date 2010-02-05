<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contact extends Controller_Application {
    
    public function action_index()
    {                
        $this->template->section = 'contact';
        $this->template->title[] = 'Contact';
        $this->template->content = View::factory('contact/index')
                                         ->bind('form', $form)
                                         ->bind('errors', $errors);
        
        if ($_POST)
        {
            $form = Validate::factory($_POST)
                              ->filter(TRUE, 'trim')
                              ->rule('name', 'not_empty')
                              ->rule('email', 'not_empty')
                              ->rule('email', 'email')
                              ->rule('subject', 'not_empty')
                              ->rule('message', 'not_empty');
            if ($form->check())
            {
                // create email
                $message = Swift_Message::newInstance()
                                          ->setSubject('Hacker Tees - '.$form['subject'])
                                          ->setFrom(array($form['email'] => $form['name']))
                                          ->setTo(array('abi@hackertees.com', 'cory@hackertees.com'))
                                          ->setBody($form['message']);

                $transport = Swift_SmtpTransport::newInstance(Kohana::config('swift')->get('host'))
                                                  ->setUsername(Kohana::config('swift')->get('username'))
                                                  ->setPassword(Kohana::config('swift')->get('password'));

                // send message
                Swift_Mailer::newInstance($transport)
                              ->send($message);
                
                
                
                $this->template->content = View::factory('contact/thanks');
            }
            else
            {
                $errors = $form->errors('contact');
            }
        }
                
    }    
}

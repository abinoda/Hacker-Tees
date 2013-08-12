<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contact extends Controller_Application {
    
    public function action_index()
    {   
        $title = 'Contact';
        $this->template->section = 'contact';
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
                                          ->setTo(array('abrahamnoda+hackertees@gmail.com'))
                                          ->setBody($form['message']);

                $transport = Swift_SmtpTransport::newInstance(Kohana::config('swift')->get('host'))
                                                  ->setUsername(Kohana::config('swift')->get('username'))
                                                  ->setPassword(Kohana::config('swift')->get('password'));

                // send message
                Swift_Mailer::newInstance($transport)
                              ->send($message);
                
                
                $title = 'Thank you for contacting us!';
                $this->template->content = View::factory('contact/thank_you');
            }
            else
            {
                $errors = $form->errors('contact');
            }
        }
        
        $this->template->title[] = $title;        
    }    
}

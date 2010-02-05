<?php defined('SYSPATH') or die('No direct script access.');

class Controller_IPN extends Controller {

    public function action_index()
    {   
        if ($_POST)
        {
            $req = 'cmd=_notify-validate';
            foreach ($_POST as $key => $value)
            {
                $value = urlencode(stripslashes($value));
                $req .= "&$key=$value";
            }
            
            $headers = "POST /cgi-bin/webscr HTTP/1.0\r\n";
            $headers .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $headers .= "Content-Length: " . strlen($req) . "\r\n\r\n";
            
            $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);

            if ( ! $fp) 
            {
                throw new ApplicationException('fsockopen() failed');
            } 
            else
            {
                fputs($fp, $headers . $req);

                while ( ! feof($fp)) 
                {
                    $result = fgets($fp, 1024);
                    
                    if (strcmp($result, "VERIFIED") == 0)
                    {
                        if ($_POST['payment_status'] == 'Completed')
                        {
                            $num_cart_items = (int) $_POST['num_cart_items'];
                            
                            $order = ORM::factory('order')
                                          ->values(array
                                            (    
                                                'txn_id'         => $_POST['txn_id'],
                                                'address_name'   => $_POST['address_name'],
                                                'address_street' => $_POST['address_street'],
                                                'address_city'   => $_POST['address_city'],
                                                'address_state'  => $_POST['address_state'],
                                                'address_zip'    => $_POST['address_zip'],
                                                'payer_email'    => $_POST['payer_email']
                                           ));
                            
                            for ($i = 1; $i <= $num_cart_items; $i++)
                            {
                                $item_number_key = 'item_number'. (string) $i;
                                $quantity        = $_POST['quantity'. (string) $i];
                                
                                $exploded_item_number = explode('_', $_POST[$item_number_key]);
                                
                                if (count($exploded_item_number) == 3)
                                {
                                    $order->_items[] = array
                                                       (
                                                           "tee_id"   => $exploded_item_number[1],
                                                           "size"     => $exploded_item_number[2],
                                                           "quantity" => $quantity          
                                                       );
                                }
                            }
                                                  
                            if ( ! empty($order->_items))
                            {
                                try
                                {                                    
                                    $order->process();
                                }
                                catch (Kohana_Exception $e)
                                {
                                    throw new Kohana_Exception('ipn error: '.$e->getMessage());
                                }
                            }
                            else
                            {
                                throw new ApplicationException('array $items is empty');
                            }
                        }
                        else
                        {
                            throw new ApplicationException('payment_status !== Completed');
                        }
                    }
                    else if (strcmp($result, "INVALID") == 0) 
                    {
                        Kohana::$log->add('IPN', 'INVALID');
                    }
                }
                fclose ($fp);            
            }    

            $email = Swift_Message::newInstance()
                                    ->setSubject('IPN')
                                    ->setFrom(array($_POST['payer_email'] => $_POST['address_name']))
                                    ->setTo('abi@hackertees.com')
                                    ->setBody($order->__toString());

            $transport = Swift_SmtpTransport::newInstance(Kohana::config('swift')->get('host'))
                                              ->setUsername(Kohana::config('swift')->get('username'))
                                              ->setPassword(Kohana::config('swift')->get('password'));

            Swift_Mailer::newInstance($transport)->send($email);
        }
        else
        {
            throw new ReflectionException;
        }
    }
    
    public function action_test()
    {   
        if ($_GET['payment_status'] == 'Completed')
        {
            $num_cart_items = (int) $_GET['num_cart_items'];
            
            $order = ORM::factory('order')
                          ->values(array
                            (    
                                'txn_id'         => $_GET['txn_id'],
                                'address_name'   => $_GET['address_name'],
                                'address_street' => $_GET['address_street'],
                                'address_city'   => $_GET['address_city'],
                                'address_state'  => $_GET['address_state'],
                                'address_zip'    => $_GET['address_zip'],
                                'payer_email'    => $_GET['payer_email']
                           ));
            
            for ($i = 1; $i <= $num_cart_items; $i++)
            {
                $item_number_key = 'item_number'. (string) $i;
                $quantity        = $_GET['quantity'. (string) $i];
                
                $exploded_item_number = explode('_', $_GET[$item_number_key]);
                
                if (count($exploded_item_number) == 3)
                {
                    $order->_items[] = array
                                       (
                                           "tee_id"   => $exploded_item_number[1],
                                           "size"     => $exploded_item_number[2],
                                           "quantity" => $quantity          
                                       );
                }
            }
                                  
            if ( ! empty($order->_items))
            {
                try
                {                                    
                    $order->process();
                }
                catch (Kohana_Exception $e)
                {
                    throw new Kohana_Exception('ipn error: '.$e->getMessage());
                }
            }
            else
            {
                throw new ApplicationException('array $items is empty');
            }
        }
        else
        {
            throw new ApplicationException('payment_status !== Completed');
        }
    }

}
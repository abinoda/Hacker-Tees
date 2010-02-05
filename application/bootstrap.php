<?php defined('SYSPATH') or die('No direct script access.');

require Kohana::find_file('vendor', 'swift/lib/swift_required');

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://docs.kohanaphp.com/about.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @see  http://docs.kohanaphp.com/about.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://docs.kohanaphp.com/about.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the production status by the domain.
 */
define('IN_PRODUCTION', $_SERVER['SERVER_NAME'] !== 'localhost');

//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */ 
Kohana::init(array(
        'base_url'   => IN_PRODUCTION ? 'http://hackertees.com/' : 'http://localhost:8888/hackertees/',
        'index_file' => FALSE,
        'profile'    => ! IN_PRODUCTION,
        'caching'    => IN_PRODUCTION
    ));
/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	    'database'   => MODPATH.'database',
	    'orm'        => MODPATH.'orm',
	    'csrf'       => MODPATH.'csrf'
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('rss', 'rss')
	->defaults(array(
		'controller' => 'rss',
		'action'     => 'tees'
	));

Route::set('ipn', 'ipn')
	->defaults(array(
		'controller' => 'ipn',
		'action'     => 'index'
	));

Route::set('thanks', 'thanks')
	->defaults(array(
		'controller' => 'tees',
		'action'     => 'thanks'
	));

Route::set('contact', 'contact')
	->defaults(array(
		'controller' => 'contact',
		'action'     => 'index'
	));

Route::set('email_signup', 'email_signup')
	->defaults(array(
		'controller' => 'emails',
		'action'     => 'new'
	));

Route::set('page', '<name>', array('name' => 'about|faq')) 
    ->defaults(array( 
        'controller' => 'pages', 
        'action' => 'show' 
    ));

Route::set('tees', '(<slug>)')
	->defaults(array(
		'controller' => 'tees',
		'action'     => 'index',
	));

/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */
$request = Request::instance();

try
{
    $request->execute();
}
catch (Exception $e)
{
    if ( ! IN_PRODUCTION)
    {
        throw $e;
    }

    Kohana::$log->add(Kohana::ERROR, Kohana::exception_text($e));

    if ($e instanceof ReflectionException) // default 404
    {
        $request->response = View::factory('layouts/error')
                                   ->set('title', "The page you were looking for doesn't exist.")
                                   ->set('content', "You may have mistyped the address or the page may have moved.");
    }
    else if ($e instanceof ApplicationException) // custom
    {
        $request->status   = $e->getCode();
        $request->response = View::factory('layouts/error')
                                   ->set('title', $e->getMessage())
                                   ->set('content', $e->getMessage());
    }
    else // default 500
    {
        $request->response = View::factory('layouts/error')
                                   ->set('title', "We're sorry, but something went wrong.")
                                   ->set('content', "We've been notified about this issue and we'll take a look at it shortly.");
    }
}
    
echo $request->send_headers()->response;
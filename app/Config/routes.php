<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	// Router::connect('/', array('controller' => 'adminusers', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */

	Router::connect('/admin',array('controller' => 'admin_users', 'action' => 'login'));
	Router::connect('/admin/login',array('controller' => 'admin_users', 'action' => 'login'));
	Router::connect('/admin/logout',array('controller' => 'admin_users', 'action' => 'logout'));
	Router::connect('/admin/customer',array('controller' => 'admin_customers', 'action' => 'index'));
	Router::connect('/admin/customer/:action/*',array('controller' => 'admin_customers'));
	Router::connect('/admin/service/:action/*',array('controller' => 'admin_services'));
	Router::connect('/admin/serviceprovider/:action/*',array('controller' => 'admin_service_providers'));
	Router::connect('/admin/subservice/:action/*',array('controller' => 'admin_sub_services'));
	Router::connect('/admin/question/:action/*',array('controller' => 'admin_questions'));
	Router::connect('/admin/servicerequest/:action/*',array('controller' => 'admin_service_requests'));
	Router::connect('/admin/report/:action/*',array('controller' => 'admin_reports'));
	Router::connect('/admin/cleaner/:action/*',array('controller' => 'admin_cleaners'));


	Router::connect('/master',array('controller' => 'master_users', 'action' => 'index'));
	Router::connect('/master/login',array('controller' => 'master_users', 'action' => 'login'));
	Router::connect('/masteruser/:action/*',array('controller' => 'master_users'));

	Router::connect('/master/cleaner',array('controller' => 'master_cleaners', 'action' => 'index'));
	Router::connect('/master/cleaner/login',array('controller' => 'master_cleaners', 'action' => 'login'));
	Router::connect('/master/cleaner/:action/*',array('controller' => 'master_cleaners'));

	Router::connect('/',array('controller' => 'users', 'action' => 'index'));
	Router::connect('/user/index',array('controller' => 'users', 'action' => 'index'));
	Router::connect('/user/login',array('controller' => 'users', 'action' => 'login'));
	Router::connect('/user/facebooklogin',array('controller' => 'users', 'action' => 'facebookLogin'));
	Router::connect('/user/facebook/fallback', array('controller' => 'users', 'action' => 'fbcallback'));
	Router::connect('/user/fbcallback', array('controller' => 'users', 'action' => 'fbcallback'));
	Router::connect('/user/register', array('controller' => 'users', 'action' => 'add'));
	Router::connect('/user/logout',array('controller' => 'users', 'action' => 'logout'));

	Router::connect('/user/profile',array('controller' => 'users', 'action' => 'profile'));
	Router::connect('/user/detail/*',array('controller' => 'users', 'action' => 'detail'));
	Router::connect('/user/serviceprovider',array('controller' => 'users', 'action' => 'spindex'));
	
	Router::connect('/servicerequest/:action/*',array('controller' => 'service_requests'));
	Router::connect('/mya/servicerequest/:action/*',array('controller' => 'service_requests'));
	Router::connect('/eng/servicerequest/:action/*',array('controller' => 'service_requests'));


	Router::connect('/:language/:controller/:action/*', array(), array('language' => '[a-z]{3}'));


/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

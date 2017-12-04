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
	// Router::connect('myanant.com', array('default' => 'myanant.com/mya/user/index'));

	Router::connect('/admin',array('controller' => 'adminusers', 'action' => 'login'));
	Router::connect('/admin/login',array('controller' => 'adminusers', 'action' => 'login'));
	Router::connect('/admin/customer',array('controller' => 'admincustomers', 'action' => 'index'));
	Router::connect('/admin/customer/:action/*',array('controller' => 'admincustomers'));
	Router::connect('/admin/service/:action/*',array('controller' => 'adminservices'));
	Router::connect('/admin/serviceprovider/:action/*',array('controller' => 'adminserviceproviders'));
	Router::connect('/admin/subservice/:action/*',array('controller' => 'adminsubservices'));
	Router::connect('/admin/question/:action/*',array('controller' => 'adminquestions'));
	Router::connect('/admin/servicerequest/:action/*',array('controller' => 'adminservicerequests'));

	Router::connect('/',array('controller' => 'users', 'action' => 'index'));
	Router::connect('/user/index',array('controller' => 'users', 'action' => 'index'));
	Router::connect('/user/login',array('controller' => 'users', 'action' => 'login'));
	Router::connect('/user/facebooklogin',array('controller' => 'users', 'action' => 'facebookLogin'));
	Router::connect('/user/facebook/fallback', array('controller' => 'users', 'action' => 'fbcallback'));
	Router::connect('/user/fbcallback', array('controller' => 'users', 'action' => 'fbcallback'));
	Router::connect('/user/register', array('controller' => 'users', 'action' => 'add'));
	Router::connect('/user/logout',array('controller' => 'users', 'action' => 'logout'));


	// Router::connect('/servicerequest/add/*',array('controller' => 'servicerequests', 'action' => 'add'));
	Router::connect('/servicerequest/:action/*',array('controller' => 'servicerequests'));


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

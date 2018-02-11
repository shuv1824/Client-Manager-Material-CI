<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Default CodeIgniter Routes
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Login route
$route['login'] = 'Auth/index';

// Logout route
$route['logout'] = 'Auth/logout';

// Unauthorized route
$route['unauthorized'] = 'User/unauthorized';

// Password Reset route
$route['resetpassword'] = 'Auth/viewPassReset';

// Users routes
$route['users'] = 'User/index';
$route['user/add'] = 'User/show';
$route['user/store'] = 'User/store';
$route['user/edit/(:num)'] = 'User/edit/$1';
$route['user/update'] = 'User/update';

// Clients routes
$route['clients'] = 'Client/index';
$route['client/add'] = 'Client/show';
$route['client/store'] = 'Client/store';
$route['client/edit/(:num)'] = 'Client/edit/$1';
$route['client/update'] = 'Client/update';
$route['client/assign_user'] = 'Client/assignToUser';
$route['clients/assigned'] = 'Client/myClients';

// Assignment routes
$route['assignments'] = 'Assignment/index';
$route['assignment/assign'] = 'Assignment/show';
$route['assignments'] = 'Assignment/index';
$route['assignments/assigned'] = 'Assignment/assignments';
$route['assignment/edit/(:num)'] = 'Assignment/edit/$1';
$route['assignment/(:num)'] = 'Assignment/assignmentDetailsView/$1';

//Response routes
$route['respond/(:num)']  = 'Response/responseView/$1';

// Notification route
$route['notifications'] = 'Notification/allNotifications';
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';


/*------------------- Site routing[start] ------------------------*/
// Model Website routing [start]
$route['sign-up'] = "user/signup";
$route['my-account'] = "user/my-account";
$route['verify-account/(:any)'] = "user/verify-account/$1";
$route['login'] = "home/login";
//$route['register'] = "home/register";   
//$route['signup-successful'] = 'home/login';

$route['albums/page/(:num)'] = 'albums/index/$1';
$route['albums/page'] = 'albums';

$route['videos/page/(:num)'] = 'videos/index/$1';
$route['videos/page'] = 'videos';

$route['albums/photos/(:num)/(:any)/page/(:num)'] = 'albums/photos/$1/$2/$3/';
$route['albums/photos/(:num)/(:any)/page'] = 'albums/photos/$1/$2';

$route['about-us'] = 'home/about';
$route['contact-us'] = 'home/contact';
$route['privacy-policy'] = 'common/privacy_policy';
//$route['contact'] = 'common/contact_us';
// $route['albums/page'] = 'albums';

$route['my-orders/page/(:num)'] = 'my-orders/index/$1';
$route['my-orders/page'] = 'my-orders';

$route['blog/page/(:num)'] = 'blog/index/$1';
$route['blog/page'] = 'blog/index';


$route['file-download/(:any)'] = 'common/file_download/$1';


// Model Website routing [end]
/*
// Front end username replicated url routing[start]

$route['('.AFFURLNAME.')/(join-now)'] = 'user/$2';
$route['(join-now)'] = 'user/$1';
$route['('.AFFURLNAME.')/(customer-join-now)'] = 'user/$2';
$route['(customer-join-now)'] = 'user/$1';
$route['('.AFFURLNAME.')/shopping_cart/set_current_url/(:num)'] = 'shopping_cart/set_current_url/$2';
$route['('.AFFURLNAME.')/common/get_state_dd_ajax/(:any)'] = 'common/get_state_dd_ajax/$2';
$route['('.AFFURLNAME.')/common/get_state_dd_ajax/(:any)/(:any)'] = 'common/get_state_dd_ajax/$2/$3';
$route['('.AFFURLNAME.')'] = 'home/index';
$route['('.AFFURLNAME.')/home'] = 'home/index';
$route['('.AFFURLNAME.')/product'] = 'product';
$route['('.AFFURLNAME.')/product/details/(:num)/(:any)'] = 'product/details/$2/$3';

$route['('.AFFURLNAME.')/shopping-cart'] = 'shopping-cart';
$route['('.AFFURLNAME.')/shopping-cart/(.*)'] = 'shopping-cart/$2';
$route['('.AFFURLNAME.')/(checkout)'] = 'checkout';
$route['('.AFFURLNAME.')/checkout/confirm'] = 'checkout/confirm';
$route['('.AFFURLNAME.')/checkout/success'] = 'checkout/success';
$route['('.AFFURLNAME.')/checkout/unsuccess'] = 'checkout/unsuccess';

$route['('.AFFURLNAME.')/signup-successful'] = 'user/signup-successful';


$route['('.AFFURLNAME.')/(about-us|company|contact-us|policy-and-procedures|anti-spam-policy|terms-and-conditions|refund-policy)'] = 'common/$2';
$route['(about-us|company|contact-us|policy-and-procedures|anti-spam-policy|terms-and-conditions|refund-policy)'] = 'common/$1';



$route['('.AFFURLNAME.')/blog'] = "blog";

// Front end username replicated url routing[end]
*/

$route['login'] = "user/login";
$route[ADMIN_FOLDER.'/blog/add-reply/(:any)'] = ADMIN_FOLDER."/blog/add/$1";
$route[ADMIN_FOLDER.'/settings'] = ADMIN_FOLDER."/common/settings";
//$route[ADMIN_FOLDER.'/banner'] = ADMIN_FOLDER."/common/banner";
//$route[ADMIN_FOLDER.'/banner/(:any)'] = ADMIN_FOLDER."/common/banner/$1";

// User redirection [start]
$route[ADMIN_FOLDER.'/'] = ADMIN_FOLDER."/home";
$route[ADMIN_FOLDER.'/login'] = ADMIN_FOLDER."/home/login";
$route['(user|'.ADMIN_FOLDER.')/logout(/:any)?'] = ADMIN_FOLDER."/home/logout/$2";
// common redirection [end]


// User redirection [start]
$route[ADMIN_FOLDER.'/user/(:any)/listing'] = ADMIN_FOLDER."/user/listing/$1";
$route[ADMIN_FOLDER.'/user/(:any)/unassigned-members-listing'] = ADMIN_FOLDER."/user/unassigned-members-listing/$1";
$route[ADMIN_FOLDER.'/user/(:any)/edit'] = ADMIN_FOLDER."/user/edit/$1";
$route[ADMIN_FOLDER.'/user/(:any)/edit-account'] = ADMIN_FOLDER."/user/edit_account/$1";
$route[ADMIN_FOLDER.'/user/(:num)/compensation-plan'] = ADMIN_FOLDER."/user/compensation_plan/$1";

$route[ADMIN_FOLDER.'/comment/page/(:any)'] = ADMIN_FOLDER."/comment/index/$1";
$route[ADMIN_FOLDER.'/comment/page'] = ADMIN_FOLDER."/comment";
// User redirection [end]

// MPULSE routing [end]

/*------------------- Site routing[end] ------------------------*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */

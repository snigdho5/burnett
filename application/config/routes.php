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

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
$route['controll_admin'] = 'controll_admin/auth';

$route['product/(:any)'] = 'products/index/$1';
$route['category/(:any)'] = 'category/index/$1';
$route['search/(:any)'] = 'search/index/$1';
$route['account'] = 'myaccount/myprofile';
$route['Privacy-policy'] = 'privacy_policy/index';


/*--------------- seo friendly frontend url -------------------*/
$route['product-list'] = 'product_list';
$route['product-list/:any'] = 'product_list';
$route['product-list/(:any)/(:any)'] = 'product_list';
$route['product-list/(:any)/(:any)/(:any)'] = 'product_list';

$route['product-details'] = 'product_details';
$route['product-details/:any'] = 'product_details';
$route['product-details/(:any)/(:any)'] = 'product_details';
$route['user-registation'] = 'sign_up';
$route['user-registation/(:any)'] = 'sign_up/index/$1';
$route['my-account'] = 'my_profile';
$route['forgotpassword'] = 'forgot_password';
$route['resetpassword/(:any)'] = 'forgot_password/resetpassword';
$route['blog-list'] = 'blog';

$route['blog-details'] = 'blog/blog_details';
$route['blog-details/(:any)'] = 'blog/blog_details';
$route['blog-details/(:any)/(:any)'] = 'blog/blog_details';
$route['news-list'] = 'news';

$route['news-details'] = 'news/news_details';
$route['news-details/(:any)'] = 'news/news_details';
$route['news-details/(:any)/(:any)'] = 'news/news_details';
$route['privacy-policy'] = 'policy/privacy_policy';
$route['terms-and-conditions'] = 'policy/terms_and_conditions';
$route['contact-us'] = 'contact_us';

$route['checkout/order_success_paytm'] = 'Checkout/onGetOrderSuccessPaytm';
$route['check-pincode'] = 'Shiprocket_Access/onCheckPincode';
$route['units/add_edit'] = 'Product_attribute/unit_add_edit';

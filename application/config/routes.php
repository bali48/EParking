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

$route['default_controller'] = "frontend";
$route['404_override'] = 'frontend/pagenotfound';
$route['login'] = "frontend";
$route['home'] = "frontend/index";
// $route['comapny'] = 'companies/userListing';
$route['checkCompanyEmailExists'] = "companies/checkEmailExists";
/*********** USER DEFINED ROUTES *******************/
$route['About'] = "frontend/About";
$route['Faq'] = "frontend/Faq";
$route['contact'] = "frontend/Contact";
$route['search'] = "frontend/search";
$route['search/(:any)'] = "frontend/search/$1";
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['mybookings'] = "frontend/userbookings";
$route['previousbookings'] = "frontend/previousbookings";
$route['checkout'] = "frontend/checkout";
$route['editprofile'] = "frontend/editprofile";
$route['editUserprofile'] = "frontend/editUserprofile";
$route['myvehicals'] = "frontend/uservehicalsListing";
$route['editmybooking'] = "frontend/editbooking";
$route['editmybooking/(:num)'] = "frontend/editbooking/$1";
$route['updatemyvehicle'] = "frontend/updatemyvehicle";

$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "frontend/pagenotfound";
$route['checkEmailExists'] = "user/checkEmailExists";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
/*********** Bilal DEFINED ROUTES *******************/
$route['companiesListing'] = 'companies/companiesListing';
$route['companiesListing/(:num)'] = "companies/companiesListing/$1";
$route['addNewcomp'] = "companies/addNewcomp";
$route['addNewCompany'] = "companies/addNewCompany";
$route['editCompany'] = "companies/editCompany";
$route['editCompany/(:num)'] = "companies/editCompany/$1";
$route['Companyupdate'] = "companies/Companyupdate";
$route['deleteCompany'] = "companies/deleteCompany";

$route['locationListing'] = 'locations/locationListing';
$route['locationListing/(:num)'] = "locations/locationListing/$1";
$route['addNewloc'] = "locations/addNewloc";
$route['addNewLocation'] = "locations/addNewlocation";
$route['editLocation'] = "locations/editlocation";
$route['editLocation/(:num)'] = "locations/editlocation/$1";
$route['Locationupdate'] = "locations/locationupdate";
$route['deleteLocation'] = "locations/deletelocation";

$route['bookinglist'] = "Reports/reportsListing";
$route['bookinglist/(:num)'] = "Reports/reportsListing/$1";
$route['bookingtoday'] = "Reports/reportstoday";
$route['bookingtoday/(:num)'] = "Reports/bookingtoday/$1";

$route['reviewlist'] = "Reviews/reviewsListing";
$route['reviewlist/(:num)'] = "Reviews/reviewsListing/$1";
$route['addNewreview'] = "Reviews/addNewreview";
$route['addReview'] = "Reviews/addReview";
$route['editReview'] = "Reviews/editReview";
$route['editReview/(:num)'] = "Reviews/editReview/$1";
$route['Reviewupdate'] = "Reviews/Reviewupdate";


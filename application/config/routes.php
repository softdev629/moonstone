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
$route['faqs'] = 'Faqs/index';
$route['customerinformation'] = 'CustomerInformation/index';
$route['faqs/(:any)'] = 'Faqs/faq_details/$1';
$route['buyer-guide'] = 'BuyerGuide/index';
$route['privacy-policy'] = 'PrivacyPolicy/index';
$route['web-policy'] = 'PrivacyPolicy/WebPolicy';
$route['cookies-policy'] = 'PrivacyPolicy/CookiesPolicy';
$route['terms-condition'] = 'TermsCondition/index';
$route['sellers-guide'] = 'SellersGuide/index';
$route['dvla-information'] = 'DVLAInformation/index';
$route['about-new-register'] = 'AboutNewRegister/index';
$route['about-us'] = 'AboutUs/index';
$route['sell-new'] = 'Sell/sell_new';
$route['package-submit']['post'] = "Sell/package_enquiry_check";
$route['home/search_number_plates/(:any)'] = 'Home/search_number_plates/$1';
$route['reg'] = 'NumberPlatesSearch/index/';
$route['number-plate/show_modal'] = 'NumberPlatesSearch/show_modal/';
$route['number-plate/show_poa_modal'] = 'NumberPlatesSearch/show_poa_modal/';
$route['number-plate/favourite'] = 'NumberPlatesSearch/favourite/';
$route['offer-check']['post'] = "NumberPlatesSearch/offer_check";
$route['poa-check']['post'] = "NumberPlatesSearch/poa_check";
$route['enquiry-check']['post'] = "NumberPlatesSearch/enquiry_check";
$route['payment_init']['post'] = "payment/payment_init";
$route['login-check']['post'] = "Login/user_login";
$route['forgot-password']['post'] = "Login/forgot_password";
$route['reset-password/(:any)'] = 'Login/reset_password/$1';
$route['user-register']['post'] = "Login/user_register";
$route['logout'] = "Login/logout";
$route['my-orders'] = 'Orders/index/';
$route['order/(:any)'] = 'Orders/order_details/$1';
$route['my-favorite'] = 'Favorite/index/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['number-plate/loadmore'] = 'NumberPlatesSearch/loadmore/';
$route['number-plate/social-share/(:any)/(:any)/(:any)'] = 'NumberPlatesSearch/social_share/$1/$2/$3';
//Admin Routes
$route['admin'] = 'admin/auth/login';
$route['admin/login'] = 'admin/auth/login';
$route['admin/logout'] = 'admin/auth/logout';
$route['admin/user_login_process'] = 'admin/auth/user_login_process';
$route['admin/featured-plates'] = 'admin/FeaturedPlates';
$route['admin/featured-plates/add'] = 'admin/FeaturedPlates/add';
$route['admin/featured-plates/edit/(:any)'] = 'admin/FeaturedPlates/edit/$1';
$route['admin/home-content/edit/(:any)'] = 'admin/HomeContent/edit/$1';
$route['admin/buy-content/edit/(:any)'] = 'admin/BuyContent/edit/$1';
$route['admin/featured-plates/add'] = 'admin/FeaturedPlates/add';
$route['admin/featured-plates/edit/(:any)'] = 'admin/FeaturedPlates/edit/$1';
$route['admin/package-inquiries'] = 'admin/PackageInquiries/index';
$route['admin/sell-register'] = 'admin/SellRegister/index';
$route['admin/newslettersubscription'] = 'admin/NewsletterSubscription/index';
$route['admin/favourite'] = 'admin/Favourite/index';
$route['admin/plate-offers'] = 'admin/PlateOffers/index';
$route['admin/plates-inquiries'] = 'admin/PlateOffers/plates_inquiries';
$route['admin/poa-inquiries'] = 'admin/PlateOffers/poa_inquiries';
$route['admin/orders'] = 'admin/Orders/index';
$route['admin/user/add'] = 'admin/Users/add';
$route['admin/user/edit/(:any)'] = 'admin/Users/edit/$1';
$route['admin/users'] = 'admin/Users/index';
$route['admin/get_private_plates'] = "admin/Users/get_private_plates";
$route['admin/adminuser/add'] = 'admin/AdminUsers/add';
$route['admin/adminuser/edit/(:any)'] = 'admin/AdminUsers/edit/$1';
$route['admin/adminusers'] = 'admin/AdminUsers/index';
$route['admin/email-settings/edit/(:any)'] = 'admin/EmailSettings/edit/$1';
$route['admin/forgot-password'] = 'admin/auth/forgot_password';
$route['admin/forgot-password-action'] = "admin/auth/forgot_password_action";
$route['admin/reset-password/(:any)'] = 'admin/auth/reset_password/$1';
$route['admin/update_is_active'] = 'admin/Notification/update_is_active';
$route['admin/change_order_status'] = 'admin/Orders/change_order_status';
$route['admin/cron_data'] = 'admin/DailyCronData/index';
$route['admin/get_cron_items'] = "admin/DailyCronData/get_cron_items";
$route['admin/duplicate_private_plate'] = 'admin/DuplicatePrivatePlate/index';
$route['admin/private_plates_bulk'] = 'admin/DuplicatePrivatePlate/private_plates_bulk';
$route['admin/private_bulk_opration'] = 'admin/Users/private_bulk_opration';
//Frontend Routes
$route['help-services'] = 'HelpServices';


$route['stripePost']['post'] = "Stripe/stripePost";



//API Routes
$route['api/get-update-api'] = "Api/get_update_api";

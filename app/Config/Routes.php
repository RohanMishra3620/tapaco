<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Home
$routes->get('/', 'Home::index');

// Auth
$routes->get('login',             'Auth::index');
$routes->post('auth/send-otp',    'Auth::sendOtp');
$routes->post('auth/verify-otp',  'Auth::verifyOtp');
$routes->get('logout',            'Auth::logout');

// Account
$routes->get('account',                    'Account::index');
$routes->get('account/saved',             'Account::saved');
$routes->get('account/bookings',          'Account::bookings');
$routes->get('account/subscriptions',     'Account::subscriptions');
$routes->get('account/language',          'Account::language');
$routes->post('account/language',         'Account::saveLanguage');
$routes->get('account/notifications',     'Account::notifications');
$routes->post('account/notifications',    'Account::saveNotifications');

// Search
$routes->get('search',            'Search::index');

// Ritual Guides
$routes->get('ritual-guides',                   'RitualGuides::index');
$routes->get('ritual-guides/(:segment)',        'RitualGuides::article/$1');
$routes->get('ritual-guides/kit/(:segment)',    'RitualGuides::kitCheckout/$1');
$routes->post('ritual-guides/kit/(:segment)',   'RitualGuides::kitPlace/$1');
$routes->post('ritual-guides/save/(:num)',      'RitualGuides::save/$1');

// Panchang
$routes->get('panchang/today-json',              'Panchang::todayJson');
$routes->get('panchang',                        'Panchang::index');
$routes->get('panchang/vrat',                   'Panchang::vratList');
$routes->get('panchang/vrat/(:segment)',        'Panchang::vratDetail/$1');
$routes->get('panchang/download-calendar',      'Panchang::downloadCalendar');

// Purohit & Puja
$routes->get('purohit-puja',                    'PurohitPuja::index');
$routes->get('purohit-puja/(:segment)',         'PurohitPuja::detail/$1');
$routes->post('purohit-puja/(:segment)/book',   'PurohitPuja::book/$1');
$routes->get('purohit-puja/confirmed/(:num)',   'PurohitPuja::confirmed/$1');

// Bhajan Mandali
$routes->get('bhajan-mandali',                  'BhajanMandali::index');
$routes->get('bhajan-mandali/(:segment)',       'BhajanMandali::detail/$1');
$routes->post('bhajan-mandali/(:segment)/book', 'BhajanMandali::book/$1');
$routes->get('bhajan-mandali/confirmed/(:num)', 'BhajanMandali::confirmed/$1');

// WhatsApp Subscription
$routes->get('subscribe',                       'Subscription::index');
$routes->post('subscribe/pay',                  'Subscription::pay');
$routes->get('subscribe/success',               'Subscription::success');

<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultController('Front/index');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->setDefaultNamespace('App\Controllers\admin');
// 前端
$routes->get('/', 'Front::index', ['namespace' => 'App\Controllers']);
$routes->get('/c/(:segment).html', 'Front::category/$1/1', ['namespace' => 'App\Controllers']);
$routes->get('/c/(:segment)/(:num).html', 'Front::category/$1/$2', ['namespace' => 'App\Controllers']);
$routes->get('/f/(:segment).html', 'Front::feature/$1/1', ['namespace' => 'App\Controllers']);
$routes->get('/f/(:segment)/(:num).html', 'Front::feature/$1/$2', ['namespace' => 'App\Controllers']);
$routes->get('/author/(:num).html', 'Front::author/$1/1', ['namespace' => 'App\Controllers']);
$routes->get('/author/(:num)/(:num).html', 'Front::author/$1/$2', ['namespace' => 'App\Controllers']);
$routes->get('/work/(:num).html', 'Front::work/$1', ['namespace' => 'App\Controllers']);
$routes->get('/chapter/(:num).html', 'Front::chapter/$1', ['namespace' => 'App\Controllers']);
$routes->get('/authors.html', 'Front::authors', ['namespace' => 'App\Controllers']);
$routes->post('/add-comment', 'Front::addComment', ['namespace' => 'App\Controllers']);
// 登录
$routes->get('login', 'Admin::login');
$routes->post('login/check', 'Admin::loginCheck');
$routes->get('logout', 'Admin::logout');
// 系统设置
$routes->get('adm', 'Admin::index');
$routes->get('admin/console', 'Admin::index');
$routes->get('admin/settings', 'Settings::index');
$routes->post('admin/settings/maintain', 'Settings::maintain');
$routes->get('admin/settings/delete/logo', 'Settings::deleteLogo');
$routes->get('admin/settings/delete/background', 'Settings::deleteBg');
$routes->get('admin/spt/list', 'Script::list');
$routes->get('admin/spt/data', 'Script::data');
$routes->get('admin/spt/edit/(:num)', 'Script::edit/$1');
$routes->post('admin/spt/maintain', 'Script::maintain');
$routes->get('admin/spt/delete/(:num)', 'Script::delete/$1');
$routes->get('admin/nav/list', 'Navigator::list/0/0');
$routes->get('admin/nav/list/(:num)', 'Navigator::list/$1/0');
$routes->get('admin/nav/list/(:num)/(:num)', 'Navigator::list/$1/$2');
$routes->get('admin/nav/settings/(:num)', 'Navigator::settings/$1');
$routes->get('admin/nav/settings/(:num)/(:num)', 'Navigator::settings/$1/$2');
$routes->post('admin/nav/maintain', 'Navigator::maintain');
$routes->post('admin/nav/candidates', 'Navigator::candidates');
$routes->get('admin/nav/data/(:num)', 'Navigator::data/$1');
$routes->post('admin/nav/change-order/(:num)', 'Navigator::changeOrder/$1');
$routes->post('admin/nav/delete', 'Navigator::delete');
$routes->get('admin/sitemap', 'Sitemap::index');
$routes->get('admin/sitemap/gen', 'Sitemap::gen');
$routes->get('admin/remote/gen', 'Remote::gen');
$routes->get('admin/remote/add-chapter', 'Remote::addChapter');
// 内容管理
$routes->get('admin/user/list', 'User::list');
$routes->get('admin/user/data', 'User::data');
$routes->get('admin/user/settings/(:num)', 'User::settings/$1');
$routes->get('admin/user/settings', 'User::settings/0');
$routes->post('admin/user/maintain', 'User::maintain');
$routes->post('admin/user/delete', 'User::delete');
$routes->get('admin/category/list', 'Category::list/0/0');
$routes->get('admin/category/list/(:num)', 'Category::list/$1/0');
$routes->get('admin/category/list/(:num)/(:num)', 'Category::list/$1/$2');
$routes->get('admin/category/data/(:num)', 'Category::data/$1');
$routes->get('admin/category/settings/(:num)/(:num)', 'Category::settings/$1/$2');
$routes->get('admin/category/settings/(:num)', 'Category::settings/$1/0');
$routes->post('admin/category/maintain', 'Category::maintain');
$routes->post('admin/category/delete', 'Category::delete');
$routes->post('admin/category/change-order/(:num)', 'Category::changeOrder/$1');
$routes->get('admin/category/suggest', 'Category::suggest');
$routes->get('admin/author/list', 'Author::list');
$routes->post('admin/author/data', 'Author::data');
$routes->get('admin/author/settings', 'Author::settings/0');
$routes->get('admin/author/settings/(:num)', 'Author::settings/$1');
$routes->post('admin/author/maintain', 'Author::maintain');
$routes->get('admin/author/delete/(:num)', 'Author::delete/$1');
$routes->get('admin/author/works/(:num)', 'Author::works/$1');
$routes->get('admin/author/suggest', 'Author::suggest');
$routes->post('admin/work/author/(:num)', 'Work::author/$1');
$routes->get('admin/feature/list', 'Feature::list');
$routes->get('admin/feature/data', 'Feature::data');
$routes->get('admin/feature/settings/(:num)', 'Feature::settings/$1');
$routes->get('admin/feature/settings', 'Feature::settings/0');
$routes->post('admin/feature/maintain', 'Feature::maintain');
$routes->get('admin/feature/delete/cover/(:num)', 'Feature::deleteCover/$1');
$routes->get('admin/feature/delete/bg/(:num)', 'Feature::deleteBg/$1');
$routes->get('admin/feature/delete/(:num)', 'Feature::delete/$1');
$routes->get('admin/feature/records/(:num)', 'Feature::records/$1');
$routes->Post('admin/feature/record/add/(:num)/(:num)', 'Feature::addRecord/$1/$2');
$routes->Post('admin/feature/record/change-order/(:num)', 'Feature::changeRecordOrder/$1');
$routes->Post('admin/feature/records/delete', 'Feature::deleteRecords');
$routes->get('admin/work/list', 'Work::list');
$routes->post('admin/work/data', 'Work::data');
$routes->get('admin/work/settings/(:num)', 'Work::settings/$1');
$routes->get('admin/work/settings', 'Work::settings/0');
$routes->post('admin/work/maintain', 'Work::maintain');
$routes->get('admin/work/delete/cover/(:num)', 'Work::deleteCover/$1');
$routes->post('admin/work/delete', 'Work::delete');
$routes->get('admin/work/suggest', 'Work::suggest');
$routes->post('admin/work/feature/(:segment)', 'Work::feature/$1');
$routes->get('admin/chapter/all/(:num)', 'Chapter::all/$1');
$routes->get('admin/chapter/all/(:num)/(:num)', 'Chapter::all/$1/$2');
$routes->get('admin/chapter/(:num)', 'Chapter::edit/$1/0');
$routes->get('admin/chapter/edit/(:num)/(:num)', 'Chapter::edit/$1/$2');
$routes->get('admin/chapter/edit/(:num)', 'Chapter::edit/$1/0');
$routes->post('admin/chapter/maintain', 'Chapter::maintain');
$routes->post('admin/chapter/upload', 'Chapter::uploadWork');
$routes->get('admin/chapter/delete/(:num)/(:num)/(:num)', 'Chapter::delete/$1/$2/$3');
$routes->get('admin/chapter/delete-vol/(:num)/(:num)', 'Chapter::deleteVol/$1/$2');
$routes->get('admin/chapter/delete-all/(:num)', 'Chapter::deleteAll/$1');
$routes->get('admin/volume/suggest/(:num)', 'Volume::suggest/$1');
// 评论管理
$routes->get('admin/comment/delete/(:num)', 'Comment::delete/$1');
$routes->get('admin/comment/approve/(:num)', 'Comment::approve/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

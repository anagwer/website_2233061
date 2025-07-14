<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Default controller
$route['default_controller'] = 'welcome';

// Route untuk login
$route['login'] = 'login';

// Route untuk dashboard
$route['dashboard'] = 'dashboard';

// Route untuk halaman blog
$route['blog'] = 'welcome/blog';
$route['blog/(:num)'] = 'welcome/blog/$1';

// Route untuk halaman portofolio
$route['portofolio'] = 'welcome/portofolio';
$route['portofolio/(:any)'] = 'welcome/portofolio_detail/$1';

// Route untuk halaman layanan
$route['layanan'] = 'welcome/layanan';
$route['layanan/(:num)'] = 'welcome/layanan/$1';

// Route untuk halaman kategori artikel
$route['kategori/(:any)'] = 'welcome/kategori/$1';
$route['kategori/(:any)/(:num)'] = 'welcome/kategori/$1/$2';

// Route untuk halaman pencarian artikel
$route['search'] = 'welcome/search';
$route['search/(:any)'] = 'welcome/search/$1';
$route['search/(:any)/(:num)'] = 'welcome/search/$1/$2';

// Route untuk halaman page statis
$route['page/(:any)'] = 'welcome/page/$1';

// Route fallback untuk artikel dengan URL SEO-friendly
$route['(:any)'] = 'welcome/single/$1';

// Custom 404 page
$route['404_override'] = 'welcome/notfound';

// Pengaturan untuk translate dash di URL menjadi underscore
$route['translate_uri_dashes'] = FALSE;

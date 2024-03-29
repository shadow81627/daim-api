<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

use App\Http\Controllers\Api\Tenant\ArticleController;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// Route::middleware([
//     'web',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     Route::get('/', function () {
//         return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
//     });
// });

Route::group([
    'prefix' => '/clients/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
    JsonApiRoute::server('tenant')
        ->resources(function (ResourceRegistrar $server) {
            $server->resource('articles', ArticleController::class);
        });
});

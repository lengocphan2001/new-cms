<?php

use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
require __DIR__ . '/auth.php';

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    Route::get('terms', 'FrontendController@terms')->name('terms');

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/{id}', ['as' => "{$module_name}.profile", 'uses' => "{$controller_name}@profile"]);
        Route::get('profile/{id}/edit', ['as' => "{$module_name}.profileEdit", 'uses' => "{$controller_name}@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "{$module_name}.profileUpdate", 'uses' => "{$controller_name}@profileUpdate"]);
        Route::get('profile/changePassword/{id}', ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
        Route::patch('profile/changePassword/{id}', ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
        Route::get("{$module_name}/emailConfirmationResend/{id}", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
        Route::delete("{$module_name}/userProviderDestroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    });
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("{$module_name}", "{$controller_name}@index")->name("{$module_name}");
        Route::post("{$module_name}", "{$controller_name}@store")->name("{$module_name}.store");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/markAllAsRead", ['as' => "{$module_name}.markAllAsRead", 'uses' => "{$controller_name}@markAllAsRead"]);
    Route::delete("{$module_name}/deleteAll", ['as' => "{$module_name}.deleteAll", 'uses' => "{$controller_name}@deleteAll"]);
    Route::get("{$module_name}/{id}", ['as' => "{$module_name}.show", 'uses' => "{$controller_name}@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/create", ['as' => "{$module_name}.create", 'uses' => "{$controller_name}@create"]);
    Route::get("{$module_name}/download/{file_name}", ['as' => "{$module_name}.download", 'uses' => "{$controller_name}@download"]);
    Route::get("{$module_name}/delete/{file_name}", ['as' => "{$module_name}.delete", 'uses' => "{$controller_name}@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("{$module_name}", "{$controller_name}");


    /*
    *
    *  Project Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'projects';
    $controller_name = 'ProjectController';
    Route::resource("{$module_name}", "{$controller_name}");


    /*
    *
    *  Group Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'groups';
    $controller_name = 'GroupController';
    Route::resource("{$module_name}", "{$controller_name}");


    $module_name = 'stages';
    $controller_name = 'StageController';
    Route::resource("{$module_name}", "{$controller_name}");

    $module_name = 'stage_groups';
    $controller_name = 'StageGroupController';
    Route::resource("{$module_name}", "{$controller_name}");

    $module_name = 'stage_users';
    $controller_name = 'StageUserController';
    Route::resource("{$module_name}", "{$controller_name}");

    $module_name = 'salaries';
    $controller_name = 'SalaryController';
    Route::get('/salary-details/{user}', [SalaryController::class, 'salaryDetails'])->name("{$module_name}.salary_details");
    Route::resource("{$module_name}", "{$controller_name}");
    Route::get('/salary-details/create/{user}', [SalaryController::class,'createSalaryDetail'])->name("{$module_name}.salary_details.create");
    Route::post('/salary-details/create/{user}', [SalaryController::class,'postSalaryDetail'])->name("{$module_name}.salary_details.post_create");
    Route::get('/salary-details/show/{salaryDetail}', [SalaryController::class, 'showSalaryDetail'])->name("{$module_name}.salary_details.show");
    Route::delete('/salary-details/delete/{salaryDetail}', [SalaryController::class, 'deleteSalaryDetail'])->name("{$module_name}.salary_details.delete");


    $module_name = 'employees';
    $controller_name = 'EmployeeController';
    Route::resource("{$module_name}", "{$controller_name}");
    Route::get('/employees/{employee}/assign_stages', [EmployeeController::class, 'assignStages'])->name('employees.assign_stages');
    Route::post('/employees/{employee}/assign_stages', [EmployeeController::class, 'assign'])->name('employees.post_assign_stages');

    $module_name = 'products';
    $controller_name = 'ProductController';
    Route::resource("{$module_name}", "{$controller_name}");
    Route::get('/products/{product}/assign_stages', [ProductController::class, 'assignStages'])->name('products.assign_stages');
    Route::post('/products/{product}/assign_stages', [ProductController::class, 'assign'])->name('products.post_assign_stages');


    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("{$module_name}/profile/{id}", ['as' => "{$module_name}.profile", 'uses' => "{$controller_name}@profile"]);
    Route::get("{$module_name}/profile/{id}/edit", ['as' => "{$module_name}.profileEdit", 'uses' => "{$controller_name}@profileEdit"]);
    Route::patch("{$module_name}/profile/{id}/edit", ['as' => "{$module_name}.profileUpdate", 'uses' => "{$controller_name}@profileUpdate"]);
    Route::get("{$module_name}/emailConfirmationResend/{id}", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
    Route::delete("{$module_name}/userProviderDestroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    Route::get("{$module_name}/profile/changeProfilePassword/{id}", ['as' => "{$module_name}.changeProfilePassword", 'uses' => "{$controller_name}@changeProfilePassword"]);
    Route::patch("{$module_name}/profile/changeProfilePassword/{id}", ['as' => "{$module_name}.changeProfilePasswordUpdate", 'uses' => "{$controller_name}@changeProfilePasswordUpdate"]);
    Route::get("{$module_name}/changePassword/{id}", ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
    Route::patch("{$module_name}/changePassword/{id}", ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
    Route::get("{$module_name}/trashed", ['as' => "{$module_name}.trashed", 'uses' => "{$controller_name}@trashed"]);
    Route::patch("{$module_name}/trashed/{id}", ['as' => "{$module_name}.restore", 'uses' => "{$controller_name}@restore"]);
    Route::get("{$module_name}/index_data", ['as' => "{$module_name}.index_data", 'uses' => "{$controller_name}@index_data"]);
    Route::get("{$module_name}/index_list", ['as' => "{$module_name}.index_list", 'uses' => "{$controller_name}@index_list"]);
    Route::resource("{$module_name}", "{$controller_name}");
    Route::patch("{$module_name}/{id}/block", ['as' => "{$module_name}.block", 'uses' => "{$controller_name}@block", 'middleware' => ['permission:block_users']]);
    Route::patch("{$module_name}/{id}/unblock", ['as' => "{$module_name}.unblock", 'uses' => "{$controller_name}@unblock", 'middleware' => ['permission:block_users']]);
});
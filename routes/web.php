<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

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

Route::get('/', function () {
    Auth::logout();
    return redirect('/login');
    // return view('welcome');
    // app()[PermissionRegistrar::class]->forgetCachedPermissions();
    // create permissions
    // Permission::create(['name' => 'edit posts']);
    // Permission::create(['name' => 'delete posts']);
    // Permission::create(['name' => 'publish posts']);
    // Permission::create(['name' => 'unpublish posts']);
    // create roles and assign existing permissions
    // $role1 = Role::create(['name' => 'admin']);
    // $role1 = Role::find(1);
    // $role1->givePermissionTo('edit posts');
    // $role1->givePermissionTo('delete posts');

    // $user = User::find(5);

    // $user = User::create([
    //     "name" => "lahiru sampath",
    //     "email" => "lahiru@gmail.com",
    //     "password" => Hash::make(123),
    // ]);

    // $user->assignRole($role1);

    // return 'ok';
});

Route::get('/posts/index', function () {
    $posts = Post::get();
    return view('posts_view.posts')->with(['data' => $posts]);
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::controller(\App\Http\Controllers\PostController::class)->prefix('post')->name('post.')->group(function () {
        Route::get('/edit/posts/{post:id}', 'editPost')->name('edit');
        Route::post('/delete/posts/{post:id}', 'deletePost')->name('delete');
    });

    Route::middleware(['admin_check'])->group(function () {
        Route::controller(\App\Http\Controllers\PermissionController::class)->prefix('permission')->name('permission.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::post('/assign', 'assign')->name('assign');
            Route::post('/revoke', 'revoke')->name('revoke');
        });
    });
});

Route::get('/assign-remove', function () {
    $role = Role::find(2);
    // $role->revokePermissionTo('edit posts');
    $role->revokePermissionTo('delete posts');
    return 'revoke ok';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

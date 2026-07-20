<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShopSettingController;
use App\Http\Controllers\CategoryLanguageController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AttandentController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProvinceController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MySendEmail;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DetectionController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\StaffMemberController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('themes/shop/welcome');
// });

// Route::prefix('contact-license')->group(function () {
//     Route::get('/', function () {
//     return view('license.contact');
//    })->name('license.contact');

//     Route::get('/activate-license', [LicenseController::class, 'showForm'])->name('license.form');
//     Route::post('/activate-license', [LicenseController::class, 'activate'])->name('license.activate');
// });



Route::prefix('contact-license')->group(function () {
    Route::get('/', function () {
    return view('license.contact');
   })->name('license.contact');

    Route::get('/activate-license', [LicenseController::class, 'showForm'])->name('license.form');
    Route::post('/activate-license', [LicenseController::class, 'activate'])->name('license.activate');
});


Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});

Route::get('send_mail', [MailController::class,'index']);

Route::get('welcome', function () {
    return View('welcome');
});


Route::get('/', [FrontController::class, 'index']);
Route::get('/about', [FrontController::class, 'about']);
Route::get('/checkout', [FrontController::class, 'checkout']);
Route::get('/contact', [FrontController::class, 'contact']);
Route::post('/contact', [FrontController::class, 'contactStore'])->name('contact.store');
Route::get('/faq', [FrontController::class, 'faq']);
Route::get('/news_details', [FrontController::class, 'news_details']);
Route::get('/news_grid', [FrontController::class, 'news_grid']);
Route::get('/news', [FrontController::class, 'news']);
Route::get('/shop_cart', [FrontController::class, 'shop_cart']);
Route::get('/book_details/{id}', [FrontController::class, 'shop_details']);
Route::get('/shop_list', [FrontController::class, 'shop_list']);
Route::get('/books/{slug}', [FrontController::class, 'shop']);
Route::get('/books', [FrontController::class, 'shop']);
Route::get('/team_details', [FrontController::class, 'team_details']);
Route::get('/team', [FrontController::class, 'team']);
Route::get('/wishlist', [FrontController::class, 'wishlist']);
Route::get('/search', [FrontController::class, 'search']);


Route::get('sendmail', [MailController::class, 'index']);
Route::get('/admin/login-qrcode', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'loginViewQrcode']);
Route::get('/reload-captcha', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'reloadCaptcha']);
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::get('/localization/{local}', [LocalizationController::class, 'index']);


Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix(prefix_url() . '/admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
        Route::get('/localization/{local}', [LocalizationController::class, 'index']);

        //reports
        Route::prefix('/reports')->group(function () {
            
            Route::get('/books', [ReportController::class, 'books']);
            Route::post('/books', [ReportController::class, 'books']);
            Route::get('/users', [ReportController::class, 'users']);
            Route::post('/users', [ReportController::class, 'users']);
            Route::get('/borrowers', [ReportController::class, 'borrowers']);
            Route::post('/borrowers', [ReportController::class, 'borrowers']);
            Route::get('/categories', [ReportController::class, 'categories']);
            Route::post('/categories', [ReportController::class, 'categories']);
            Route::get('/category_languages', [ReportController::class, 'category_languages']);
            Route::post('/category_languages', [ReportController::class, 'category_languages']);
            Route::get('/attendances', [ReportController::class, 'attendances']);
            Route::post('/attendances', [ReportController::class, 'attendances']);
            Route::get('/daily_attendances', [ReportController::class, 'daily_attendances']);
            Route::post('/daily_attendances', [ReportController::class, 'daily_attendances']);
            Route::get('/daily_borrowers', [ReportController::class, 'daily_borrowers']);
            Route::post('/daily_borrowers', [ReportController::class, 'daily_borrowers']);
            Route::get('/download_export', [ReportController::class, 'download_export']);
            // export for report
            Route::get('/export_daily_attendance_report', [ReportController::class, 'export_daily_attendance_report']);
            Route::get('/export_daily_attendance_from_view_report', [ReportController::class, 'export_daily_attendance_from_view_report']);
        });

        // sales
        Route::prefix('/sales')->group(function () {
            Route::resource('/', SaleController::class);
        });

        // purchases
        Route::prefix('/purchases')->group(function () {
            Route::resource('/', PurchaseController::class);
        });

        // products
        Route::prefix('/products')->group(function () {
            Route::resource('/', ProductController::class);
        });

        // books
        Route::prefix('/group_book')->group(function () {

            
            Route::resource('/books', BookController::class);
            Route::get('/print_barcodes', [BookController::class, 'print_barcodes']);
            Route::post('/print_barcodes', [BookController::class, 'print_barcodes']);
            Route::get('/import', [BookController::class, 'import']);
            Route::post('/import_by_csv', [BookController::class, 'import_by_csv']);
            Route::get('/filters/{val}', [BookController::class, 'filters']);
            Route::get('/get_book_data/{val}', [BookController::class, 'get_book_data']);
        });

        // borrower book
        // Route::prefix('/brorrowers')->group(function() {

        // });

        // Route::resource('/roles', RoleController::class);
        // Route::resource('permissions', PermissionController::class);

        Route::resource('/borrowers', BorrowerController::class);
        Route::get('/borrowers/repayed/{id}', [BorrowerController::class, 'repayed']);
        Route::get('/borrowers/borrowed/{id}', [BorrowerController::class, 'borrowed']);
        Route::get('/borrowers/get_data/{term}', [BorrowerController::class, 'get_data']);

        Route::prefix('/attendances')->group(function () {
            Route::resource('/', AttandentController::class);
            Route::get('/show/{id}', [AttandentController::class, 'show']);
            Route::delete('/delete/{id}', [AttandentController::class, 'destroy']);
            Route::get('/get_students/{code}', [AttandentController::class, 'get_students']);
        });

        Route::prefix('/shop_settings')->group(function () {
            Route::resource('/', ShopSettingController::class);
            Route::resource('/apikeys', ApiKeyController::class);
        });

        // people
        Route::prefix('/peoples')->group(function () {
            Route::resource('/users', UserController::class);
            Route::get('/users/status_ban/{id}', [UserController::class, 'status_ban']);
            Route::resource('/students', StudentsController::class);
            // student import and export
            // Route::get('/file-import',[StudentsController::class,'importView'])->name('import-view'); 
            // Route::post('/import',[UserController::class,'import'])->name('import');
            // Route::get('/export-users',[UserController::class,'exportUsers'])->name('export-users');
        });

        Route::resource('/contacts', ContactController::class);

        // about page
        Route::prefix('/about-page')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AboutPageController::class, 'index'])->name('about-page.index');
            Route::get('/edit', [App\Http\Controllers\Admin\AboutPageController::class, 'edit'])->name('about-page.edit');
            Route::put('/update', [App\Http\Controllers\Admin\AboutPageController::class, 'update'])->name('about-page.update');
        });

        // staff members
        Route::prefix('/staff-members')->group(function () {
            Route::get('/', [StaffMemberController::class, 'index']);
            Route::get('/create', [StaffMemberController::class, 'create']);
            Route::post('/', [StaffMemberController::class, 'store']);
            Route::get('/{id}/edit', [StaffMemberController::class, 'edit']);
            Route::put('/{id}', [StaffMemberController::class, 'update']);
            Route::delete('/{id}', [StaffMemberController::class, 'destroy']);
        });

        // messages
        Route::prefix('/messages')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
            Route::get('/{id}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
            Route::post('/{id}/mark-as-replied', [App\Http\Controllers\Admin\MessageController::class, 'markAsReplied'])->name('messages.mark-as-replied');
            Route::delete('/{id}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');
            Route::delete('/', [App\Http\Controllers\Admin\MessageController::class, 'deleteRead'])->name('messages.deleteRead');
        });

        // settings
        Route::prefix('/settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index']);
            Route::post('/', [SettingsController::class, 'store'])->name('settings.store');
            Route::get('/detections',[DetectionController::class, 'index'])->name('detections.index');
            Route::resource('/categories', CategoryController::class);
            Route::resource('/brands', BrandController::class);
            Route::resource('/provinces', ProvinceController::class);
            Route::resource('/category_langauges', CategoryLanguageController::class);
            Route::resource('/permission-groups', PermissionGroupController::class);
            Route::resource('/permissions', PermissionController::class);
            Route::resource('/roles', RoleController::class);
            Route::resource('/departments', DepartmentController::class);
            
            // Department Users Management
            Route::get('/departments/{departmentId}/users', [DepartmentUserController::class, 'index'])->name('departments.users.index');
            Route::get('/departments/{departmentId}/users/create', [DepartmentUserController::class, 'create'])->name('departments.users.create');
            Route::post('/departments/{departmentId}/users', [DepartmentUserController::class, 'store'])->name('departments.users.store');
            Route::get('/departments/{departmentId}/users/{userId}/edit', [DepartmentUserController::class, 'edit'])->name('departments.users.edit');
            Route::put('/departments/{departmentId}/users/{userId}', [DepartmentUserController::class, 'update'])->name('departments.users.update');
            Route::delete('/departments/{departmentId}/users/{userId}', [DepartmentUserController::class, 'destroy'])->name('departments.users.destroy');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/update_avatar', [ProfileController::class, 'update_avatar'])->name('profile.avatar');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // AJAX: fetch permissions for a role (used by user create/edit forms)
        Route::get('/roles/{id}/permissions', function ($id) {
            $role = \Spatie\Permission\Models\Role::with('permissions')->findOrFail($id);
            $permissions = $role->permissions->groupBy(function ($p) {
                return explode('-', $p->name)[0];
            });
            return response()->json($permissions);
        })->name('roles.permissions');
    });
});

require __DIR__ . '/auth.php';

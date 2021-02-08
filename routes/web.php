<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
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

Route::get('/', function () {
    return view('auth/login');
})->name('/');

Route::get('/search-all-doctors', function () {
    return view('doctors.search_all_doctors');
})->name('all.search');

Route::get('/doctors/profile/{id}', [DoctorController::class, 'view'])->name('doctors.view');

Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect('home');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:system admin'])->group(function () {
        // user accounts
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/add', [UserController::class, 'add'])->name('users.add');
            Route::get('/search', [UserController::class, 'search'])->name('users.search');
            Route::post('/add', [UserController::class, 'addPost'])->name('users.add.post');
            Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
        });

        // internal doctors
        Route::group(['prefix' => 'internalDocs'], function () {
            Route::get('/', [DoctorController::class, 'admin_main'])->name('internaldocs');
            Route::get('/search', [DoctorController::class, 'search'])->name('internaldocs.search');
            Route::get('/add', [DoctorController::class, 'add'])->name('internaldocs.add');
            Route::get('/edit', [DoctorController::class, 'edit'])->name('internaldocs.edit');
        });

        //external doctors
        Route::group(['prefix' => 'externalDocs'], function () {
            Route::get('/', [DoctorController::class, 'admin_main'])->name('externaldocs');
            Route::get('/search', [DoctorController::class, 'search'])->name('externaldocs.search');
            Route::get('/add', [DoctorController::class, 'add'])->name('externaldocs.add');
            Route::get('/edit', [DoctorController::class, 'edit'])->name('externaldocs.edit');
        });
    });

    Route::middleware(['role:internal|external|patient|nurse'])->get('/home', function () {
        return view('home');
    })->name('home');

    Route::middleware(['role:patient'])->group(function () {
        Route::get('/referrals', [PatientController::class, 'viewReferrals'])->name('referrals');
        Route::get('/referrals/download', [PatientController::class, 'downloadReferral'])->name('referrals.download');
        Route::get('/appointments', [PatientController::class, 'viewAppointments'])->name('appointments');
        Route::get('/appointments/new', [PatientController::class, 'newAppt'])->name('appointments.new');
        Route::get('/appointments/change/{id}', [PatientController::class, 'changeAppt'])->name('appointments.change');
        Route::get('/appointments/delete/{id}', [PatientController::class, 'delete'])->name('appointments.delete');
    });

    Route::middleware(['role:internal|external|nurse'])->group(function () {
        Route::get('/patients', [PatientController::class, 'index'])->name('patients');
        Route::get('/patients/view', [PatientController::class, 'viewPatient'])->name('patients.view');
        Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');

        Route::get('/doctors', [DoctorController::class, 'retrieve_all_doctors'])->name('doctors');
        Route::get('/doctors/search', [PatientController::class, 'search'])->name('doctors.search');

        Route::get('/referrals/add', [DoctorController::class, 'addReferral'])->name('referral.add');
    });
});

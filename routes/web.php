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
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
        Route::post('/users/add', [UserController::class, 'addPost'])->name('users.add.post');
        Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');

        // internal doctors
        Route::get('/internalDocs', [DoctorController::class, 'admin_main'])->name('internaldocs');
        Route::get('/internalDocs/search', [DoctorController::class, 'search'])->name('internaldocs.search');
        Route::get('/internalDocs/add', [DoctorController::class, 'add'])->name('internaldocs.add');
        Route::get('/internalDocs/edit', [DoctorController::class, 'edit'])->name('internaldocs.edit');

        //external doctors
        Route::get('/externalDocs', [DoctorController::class, 'admin_main'])->name('externaldocs');
        Route::get('/externalDocs/search', [DoctorController::class, 'search'])->name('externaldocs.search');
        Route::get('/externalDocs/add', [DoctorController::class, 'add'])->name('externaldocs.add');
        Route::get('/externalDocs/edit', [DoctorController::class, 'edit'])->name('externaldocs.edit');
    });

    Route::middleware(['role:internal|external|patient|nurse'])->get('/home', function () {
        return view('home');
    })->name('home');

    Route::middleware(['role:patient'])->group(function () {
        Route::get('/referrals', [PatientController::class, 'viewReferrals'])->name('referrals');
        Route::get('/appointments', [PatientController::class, 'viewAppointments'])->name('appointments');
        Route::get('/appointments/new', [PatientController::class, 'newAppt'])->name('appointments.new');
    });

    Route::middleware(['role:internal|external'])->group(function () {
        Route::get('/patients', [PatientController::class, 'index'])->name('patients');
        Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');

        Route::get('/doctors', [DoctorController::class, 'retrieve_all_doctors'])->name('doctors');
        Route::get('/doctors/search', [PatientController::class, 'search'])->name('doctors.search');
    });
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\FeesStructureController;
use App\Http\Controllers\FeestaffController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NonAtmiyaStaffFeeController;
use App\Http\Controllers\RecoverMember;
use App\Http\Controllers\RecoveryMember;
use App\Http\Controllers\ReneableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('/');

//admin
Route::prefix('atmiya-admin')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/post-login', [AuthController::class, 'postLogin'])->name('admin.login.post');
    Route::get('/register', [AuthController::class, 'registration'])->name('admin.register');
    Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('admin.register.post');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        //member
        Route::get('member', [MemberController::class, 'create'])->name('member');
        Route::post('member/store', [MemberController::class, 'store'])->name('member.store');
        Route::get('/members/edit/{id}', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{id}', [MemberController::class, 'update'])->name('member.update');
        Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

        // fees management atmiya student
        Route::get('/fees', [FeesController::class, 'index'])->name('fees');
        Route::post('/fees', [FeesController::class, 'store'])->name('fees.store');
        Route::get('/fees/edit/{id}', [FeesController::class, 'edit'])->name('fees.edit');
        Route::put('/fees/{id}', [FeesController::class, 'update'])->name('fees.update');
        Route::delete('/fees/{id}', [FeesController::class, 'destroy'])->name('fees.delete');

        // fees management atmiya staff
        Route::get('/fees-staff', [FeestaffController::class, 'index'])->name('fees.staff');
        Route::post('/fees-staff', [FeestaffController::class, 'store'])->name('fees.staff.store');
        Route::get('/fees-staff/edit/{id}', [FeestaffController::class, 'edit'])->name('fees.staff.edit');
        Route::put('/fees-staff/{id}', [FeestaffController::class, 'update'])->name('fees.staff.update');
        Route::delete('/fees-staff/{id}', [FeestaffController::class, 'destroy'])->name('fees.staff.delete');

        // fees management non atmiya
        Route::get('/fees-non-atmiya', [NonAtmiyaStaffFeeController::class, 'index'])->name('fees.non-atmiya');
        Route::post('/fees-non-atmiya', [NonAtmiyaStaffFeeController::class, 'store'])->name('fees.non-atmiya.store');
        Route::get('/fees-non-atmiya/edit/{id}', [NonAtmiyaStaffFeeController::class, 'edit'])->name('fees.non-atmiya.edit');
        Route::put('/fees-non-atmiya/{id}', [NonAtmiyaStaffFeeController::class, 'update'])->name('fees.non-atmiya.update');
        Route::delete('/fees-non-atmiya/{id}', [NonAtmiyaStaffFeeController::class, 'destroy'])->name('fees.non-atmiya.delete');

        //Fees Structure
        Route::get('/fees-structure', [FeesStructureController::class, 'index'])->name('fees.structure');

        //Renewable
        Route::get('/reneable', [ReneableController::class, 'index'])->name('reneable');
        Route::get('/members/pdf', [MemberController::class, 'exportPDF'])->name('members.pdf');

        // recovery member
        // Route::get('/recover-member', [RecoverMember::class, 'index'])->name('recovery.member');
        // Route::post('/recover-member/{id}', [RecoverMember::class, 'recover'])->name('recover.member');
        //     <li class="nav-item">
        //     <a class="nav-link {{ request()->routeIs('recovery.member') ? 'active' : '' }} fas fa-undo-alt"
        //     href="{{ route('recovery.member') }}">
        //     <p>Recovery Member</p>
        //     </a>
        //   </li>
    });
});



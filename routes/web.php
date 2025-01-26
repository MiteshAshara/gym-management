<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RecoverMember;
use App\Http\Controllers\RecoveryMember;
use App\Http\Controllers\ReneableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('admin.login');

//admin
Route::prefix('admin')->group(function () {
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

        // fees management
        Route::get('/fees', [FeesController::class, 'index'])->name('fees');
        Route::post('/fees', [FeesController::class, 'store'])->name('fees.store');
        Route::get('/fees/edit/{id}', [FeesController::class, 'edit'])->name('fees.edit');
        Route::put('/fees/{id}', [FeesController::class, 'update'])->name('fees.update');
        Route::delete('/fees/{id}', [FeesController::class, 'destroy'])->name('fees.delete');

        //Renewable
        Route::get('/reneable', [ReneableController::class, 'index'])->name('reneable');

        //recovery member
        // Route::get('/recover-member', [RecoverMember::class, 'index'])->name('recovery.member');
        //     <li class="nav-item">
        //     <a class="nav-link {{ request()->routeIs('recovery.member') ? 'active' : '' }} fas fa-undo-alt"
        //     href="{{ route('recovery.member') }}">
        //     <p>Recovery Member</p>
        //     </a>
        //   </li>
    });
});



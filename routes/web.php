<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CourseLessonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $users = User::where("id" , "!=","1")->get();
    return view('dashboard', compact('users'));
})->middleware(['auth', 'verified', "role:admin"])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/coaching', [CoachController::class, 'index'])->name('coach')->middleware("role:coach,admin");
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/admin/approve-user/{user}', [RegisteredUserController::class, 'approveUser'])->name('admin.approve-user');
    Route::post('/admin/switch{user}', [RegisteredUserController::class, 'switch'])->name('switch');
    Route::resource("calendar" , CalendarController::class);
    Route::resource("class" , ClasseController::class);
    Route::resource("lesson" , LessonController::class);
    Route::resource("course_user" , CourseLessonController::class);
    Route::put("/calendar/update/{calendar}" , [CalendarController::class , "update"])->name("updateCalendar");
    Route::get("/lesson/show/{lesson}" , [LessonController::class , "show"])->name("lesson.showw");
    Route::delete("/calendar/delete/{calendar}" , [CalendarController::class , "destroy"])->name("deleteCalendar");
});

require __DIR__.'/auth.php';

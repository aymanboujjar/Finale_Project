<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CourseLessonController;
use App\Http\Controllers\FinalProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MasterclasseController;
use App\Http\Controllers\ProfileController;
use App\Models\Masterclasse;
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
    Route::get('/profile_show', [HomeController::class, 'view'])->name('profile_show');
    Route::get('/classe/{class}', [HomeController::class, 'class'])->name('class');
    Route::get('/coaching', [CoachController::class, 'index'])->name('coach')->middleware("role:coach,admin");
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/admin/approve-user/{user}', [RegisteredUserController::class, 'approveUser'])->middleware("role:admin")->name('admin.approve-user');
    Route::post('/admin/switch{user}', [RegisteredUserController::class, 'switch'])->middleware("role:admin")->name('switch');
    Route::resource("calendar" , CalendarController::class);
    Route::resource("masterclasse" , MasterclasseController::class);
    Route::resource("class" , ClasseController::class);
    Route::resource("lesson" , LessonController::class);
    Route::resource("final" , FinalProjectController::class);
    Route::resource("course_user" , CourseLessonController::class);
    Route::put("/calendar/update/{calendar}" , [CalendarController::class , "update"])->middleware("role:coach,admin")->name("updateCalendar");
    Route::put("/masterclasse/update/{masterclasse}" , [MasterclasseController::class , "update"])->name("masterclasseupdate");
    Route::put("/lesson/update/{lesson}" , [LessonController::class , "update"])->middleware("role:coach,admin");
    Route::get("/lesson/show/{lesson}" , [LessonController::class , "show"])->name("lesson.showw");
    Route::delete("/calendar/delete/{calendar}" , [CalendarController::class , "destroy"])->middleware("role:coach,admin")->name("deleteCalendar");
    Route::delete("/masterclasse/delete/{masterclasse}" , [MasterclasseController::class , "destroy"])->name("deletemasterclasse");
    // Route::post('/final-project/submit', [FinalProjectController::class, 'submit'])->name('finalProject.submit');

});

require __DIR__.'/auth.php';


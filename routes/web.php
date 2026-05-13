<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AnnouncementController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\TeacherController;
use App\Http\Controllers\Frontend\StudentController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\DownloadController;
use App\Http\Controllers\Frontend\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Security hardening applied:
| - "throttle" middleware on public POST routes to reduce spam/abuse.
| - Route parameter constraints for numeric IDs.
| - Named routes for consistency.
| - Public GET routes remain cache-friendly.
|
| Rate Limits:
| - Contact form: max 5 requests per minute per IP.
| - Comment form: max 10 requests per minute per IP.
|
*/

// ======================================================================
// HOME
// ======================================================================
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// ======================================================================
// STATIC PAGES
// ======================================================================
Route::get('/profil/{slug}', [PageController::class, 'show'])
    ->name('page.show');

// ======================================================================
// BLOG
// ======================================================================
Route::prefix('blog')
    ->name('blog.')
    ->group(function () {

        Route::get('/', [PostController::class, 'index'])
            ->name('index');

        Route::get('/category/{slug}', [PostController::class, 'category'])
            ->name('category');

        Route::get('/{slug}', [PostController::class, 'show'])
            ->name('show');

        // Anti-spam protection for comments
        Route::post('/{slug}/comment', [CommentController::class, 'store'])
            ->middleware('throttle:10,1')
            ->name('comment.store');
    });

// ======================================================================
// ANNOUNCEMENTS
// ======================================================================
Route::prefix('pengumuman')
    ->name('announcement.')
    ->group(function () {

        Route::get('/', [AnnouncementController::class, 'index'])
            ->name('index');

        Route::get('/{id}', [AnnouncementController::class, 'show'])
            ->whereNumber('id')
            ->name('show');
    });

// ======================================================================
// EVENTS / AGENDA
// ======================================================================
Route::prefix('agenda')
    ->name('event.')
    ->group(function () {

        Route::get('/', [EventController::class, 'index'])
            ->name('index');

        Route::get('/{id}', [EventController::class, 'show'])
            ->whereNumber('id')
            ->name('show');
    });

// ======================================================================
// TEACHERS
// ======================================================================
Route::get('/guru', [TeacherController::class, 'index'])
    ->name('teacher.index');

// ======================================================================
// STUDENTS
// ======================================================================
Route::get('/siswa', [StudentController::class, 'index'])
    ->name('student.index');

// ======================================================================
// GALLERIES
// ======================================================================
Route::prefix('galleries')
    ->name('galleries.')
    ->group(function () {

        Route::get('/', [GalleryController::class, 'index'])
            ->name('index');

        Route::get('/{id}', [GalleryController::class, 'show'])
            ->whereNumber('id')
            ->name('show');
    });

// ======================================================================
// DOWNLOADS
// ======================================================================
Route::get('/download', [DownloadController::class, 'index'])
    ->name('download.index');

// ======================================================================
// CONTACT
// ======================================================================
Route::prefix('hubungi-kami')
    ->name('contact.')
    ->group(function () {

        Route::get('/', [ContactController::class, 'index'])
            ->name('index');

        // Anti-spam protection for contact form
        Route::post('/', [ContactController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('store');
    });
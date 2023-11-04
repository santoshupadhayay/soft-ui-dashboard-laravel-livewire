<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;

use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Livewire\Streams;
use App\Http\Livewire\AddStream;
use App\Http\Livewire\EditStream;
use App\Http\Controllers\StreamsController;
use App\Http\Livewire\Chapters;
use App\Http\Livewire\AddChapter;
use App\Http\Livewire\EditChapter;
use App\Http\Livewire\Quizs;
use App\Http\Livewire\AddQuiz;
use App\Http\Livewire\EditQuiz;
use App\Http\Livewire\Auth\Application;
// use App\Http\Livewire\Apps\App;
use Illuminate\Http\Request;
use App\Http\Livewire\KzApp;

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


 //app
 Route::get('/kzapp', KzApp::class);
 Route::any('/register', [Login::class,'register'])->name('register');
 Route::get('/loadStreams', [KzApp::class,'loadStreams'])->name('loadStreams');
 Route::get('/loadChapters/{id}', [KzApp::class,'loadChapters'])->name('loadChapters');
 Route::get('/viewChapter/{id}', [KzApp::class,'viewChapter'])->name('viewChapter');
 Route::get('/appQuiz/{id}', [KzApp::class,'appQuiz'])->name('appQuiz');
 Route::get('/createCertficate', [KzApp::class,'createCertficate'])->name('createCertficate');
 Route::post('/uploadCertificateImage', [KzApp::class,'uploadCertificateImage'])->name('uploadCertificateImage');
 Route::get('/printCertificate', [KzApp::class,'printCertificate'])->name('printCertificate');
 
 Route::get('/loadPPT', [KzApp::class,'loadPPT']);


Route::get('/', function() {
    return redirect('/login');
});
Route::get('/sign-up/{chapters?}', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');

    //strams 
    Route::get('/streams',  Streams::class)->name('streams');
    Route::get('/add-streams',  AddStream::class)->name('addStream');
    Route::post('/save-stream',  [AddStream::class, 'saveStream'])->name('saveStream');
    Route::get('/delete-stream/{id}',  [Streams::class, 'deleteStream'])->name('deleteStream');
    Route::get('/edit-stream/{id}',  EditStream::class)->name('editStream');
    Route::post('/update-stream',  [EditStream::class, 'updateStream'])->name('updateStream');

    
    //chapters
    Route::get('/chapters',  Chapters::class)->name('chapters');
    Route::get('/add-chapters',  AddChapter::class)->name('addChapter');
    Route::post('/save-chapter',  [AddChapter::class, 'saveChapter'])->name('saveChapter');
    Route::get('/delete-chapter/{id}',  [Chapters::class, 'deleteChapter'])->name('deleteChapter');
    Route::get('/edit-chapter/{id}',  EditChapter::class)->name('editChapter');
    Route::post('/update-chapter',  [EditChapter::class, 'updateChapter'])->name('updateChapter');

    //quizs
    Route::get('/quizs',  Quizs::class)->name('quizs');
    Route::get('/add-quiz',  AddQuiz::class)->name('addQuiz');
    Route::post('/save-quiz',  [AddQuiz::class, 'saveQuiz'])->name('saveQuiz');
    Route::get('/delete-quiz/{id}',  [Quizs::class, 'deleteQuiz'])->name('deleteQuiz');
    Route::get('/edit-quiz/{id}',  EditQuiz::class)->name('editQuiz');
    Route::post('/update-quiz',  [EditQuiz::class, 'updateQuiz'])->name('updateQuiz');

    Route::post('/addQuestion',  [AddQuiz::class, 'addQuestion'])->name('addQuestion');
    Route::get('/removeQuestion/{id}',  [AddQuiz::class, 'removeQuestion'])->name('removeQuestion');
    
});


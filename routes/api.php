<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuaidaAppController;
use App\Http\Controllers\Api\QuaidaAppDetailController;
use App\Http\Controllers\Api\QuaidaAppGuaideController;
use App\Http\Controllers\Api\QuaidaAppTestContoller;
use App\Http\Controllers\Api\QuaidaAppAnswerController;
use App\Http\Controllers\Api\QuranAPPController;
use App\Http\Controllers\Api\QuranAppGuaideController;
use App\Http\Controllers\Api\QuranAppWithWordController;
use App\Http\Controllers\Api\QuranappWordWithTestingController;
use App\Http\Controllers\Api\QuranAPPWithAnswerController;
use App\Http\Controllers\Api\QuranAppAyatWithTestingController;
use App\Http\Controllers\Api\QuranAppWithAyatController;
use App\Http\Controllers\Api\QuranAppAyatWithAnswerController;
use App\Http\Controllers\Api\UserAppController;
use App\Http\Controllers\Api\ProfileAppQariSahibController;
use App\Http\Controllers\Api\HroofAppVideoController;
use App\Http\Controllers\Api\TestmonialAppController;
use App\Http\Controllers\HomeScreenController;
// qamar
use App\Http\Controllers\AudioAnalysisController;
// 

/**
 * Qaida  Routes:
 * - "/"          -> Displays the about page (GET request)                      
 * - "/read"      -> Fetches all about records (GET request)                     
 * - "/store"     -> Stores a new about record (POST request)                    
 */
Route::get("/lessonApp", [QuaidaAppController::class, "QuaidaApp"])->name("QuaidaApp");
Route::get("/QuaidaDetailApp/{id}", [QuaidaAppDetailController::class, "QuaidaDetailApp"])->name("QuaidaDetailApp");
Route::get("/QuaidaGuaideApp/{id}", [QuaidaAppGuaideController::class, "QuaidaGuaideApp"])->name("QuaidaGuaideApp");
Route::get("/TestApp/{id}", [QuaidaAppTestContoller::class, "TestApp"])->name("TestApp");
Route::get("/AnswerApp/{id}", [QuaidaAppAnswerController::class, "AnswerApp"])->name("AnswerApp");
Route::post('/submitAnswerQuaida', [QuaidaAppAnswerController::class, 'submitAnswerApp']);



/**
 * Quran  Routes:
 * - "/"          -> Displays the about page (GET request)                      
 * - "/read"      -> Fetches all about records (GET request)                     
 * - "/store"     -> Stores a new about record (POST request)                    
 */

Route::get("/QuranApp", [QuranAPPController::class, "QuranApp"])->name("QuranApp");
Route::get("/QuranAppGuaide/{id}", [QuranAppGuaideController::class, "QuranAppGuaide"])->name("QuranAppGuaide");


Route::get("/QuranWithWord/{id}", [QuranAppWithWordController::class, "QuranWithWord"])->name("QuranWithWord");
Route::get("/QuranWordTesting/{id}", [QuranappWordWithTestingController::class, "QuranWordTesting"])->name("QuranWordTesting");
Route::get("/AnswerWordApp/{id}", [QuranAPPWithAnswerController::class, "AnswerWordApp"])->name("AnswerWordApp");
Route::post('/submitAnswerAppQuranWord', [QuranAPPWithAnswerController::class, 'submitAnswerAppQuranWord']);


Route::get("/QuranWithAyat/{id}", [QuranAppWithAyatController::class, "QuranWithAyat"])->name("QuranWithAyat");
Route::get("/TestAyatApp/{quranId}", [QuranAppAyatWithTestingController::class, "TestAyatApp"])->name("TestAyatApp");
Route::get("/AnswerAyatApp/{id}", [QuranAppAyatWithAnswerController::class, "AnswerAyatApp"])->name("AnswerAyatApp");
Route::post('/submitAnswerAppQuranAyat', [QuranAppAyatWithAnswerController::class, 'submitAnswerAppQuranAyat']);


Route::get("/QuaidaAudio/{quaidaId}/{id}", [QuaidaAppDetailController::class, "QuaidaDetailAudio"])->name("QuaidaDetailAudio");
Route::get("/QuranWordAudio/{quranId}/{quranAyatId}/{quranWordsId}", [QuranAppWithWordController::class, "QuranWordAudio"])->name("QuranWordAudio");
Route::get("/QuranAyatAudio/{ayahId}", [QuranAppWithAyatController::class, "QuranAyatAudio"])->name("QuranAyatAudio");
Route::get("/QuranAyatAudioSurah/{quranId}/{ayahId}", [QuranAppWithAyatController::class, "QuranAyatAudioSurah"])->name("QuranAyatAudioSurah");
/**
 * User Registerd  Routes:
 * - "/"          -> Displays the about page (GET request)                      
 * - "/read"      -> Fetches all about records (GET request)                     
 * - "/store"     -> Stores a new about record (POST request)                    
 */
Route::post('/register', [UserAppController::class, 'register']);
Route::post('/login', [UserAppController::class, 'login'])->name('login');
Route::post('/update/{id}', [UserAppController::class, 'updateApp']);
Route::post('/forgot-password', [UserAppController::class, 'forgotPassword']);
Route::post('/forgot-email', [UserAppController::class, 'retrieveEmail']);
Route::post('/delete', [UserAppController::class, 'deleteUserById']);
Route::post('/user/{id}/logout', [UserAppController::class, 'logout']);


Route::post('/store', [ProfileAppQariSahibController::class, 'store'])->name('store');
Route::put('/updateApp/{id}', [ProfileAppQariSahibController::class, 'updateApp']);
Route::get('/qariProfile', [ProfileAppQariSahibController::class, 'qariProfileApp'])->name('qariProfileApp');


Route::get("/surah-ayat/{id}", [QuranAppWithAyatController::class, "surahayat"])->name("surahayat");
Route::post('/compareVoices', [QuaidaAppController::class, 'compareVoicesapp'])->name('compareVoicesapp');
Route::get('/hroofVideo', [HroofAppVideoController::class, 'hroofVedio'])->name('hroofVedio');


Route::post('/testimonials', [TestmonialAppController::class, 'testimonials'])->name('testimonials');
Route::get('/tesmonialfile', [TestmonialAppController::class, 'tesmonialfile'])->name('tesmonialfile');


Route::get('/islameapp', [UserAppController::class, 'islameapp']);
Route::get('/visits', [HomeScreenController::class, 'getVisitsData']);
Route::get('/progress', [HomeScreenController::class, 'getProgressData']);

// qamar
Route::post('/compare-audio/{Quaida_id}/{words_id}', [QuaidaAppDetailController::class, 'compareAudio']);
//
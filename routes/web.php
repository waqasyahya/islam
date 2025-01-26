<?php
use App\Http\Controllers\EmailController;
use App\Http\Controllers\VistUserController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\QuaidaController;
use App\Http\Controllers\QuaidaDetailController;
use App\Http\Controllers\QuaidaGuaideController;
use App\Http\Controllers\QuaidaTestController;
use App\Http\Controllers\QuaidaAnswerController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\QuranWithAyatController;
use App\Http\Controllers\QuranAyatWithAnswerController;
use App\Http\Controllers\QuranAyatWithTestingController;
use App\Http\Controllers\QuranGuaideController;
use App\Http\Controllers\HomeScreenController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\ProfileQariSahibController;
use App\Http\Controllers\QuranWithWordController;
use App\Http\Controllers\QuranWordWithTestingController;
use App\Http\Controllers\QuranWordWithAnswerController;
use App\Http\Controllers\HroofVideoController;
use App\Http\Controllers\TestmonialAppController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\IslameappController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\BookmarkController;

/**
     * Home Screen  Routes:
     * - "/"          -> Displays the about page (GET request)                      
     * - "/read"      -> Fetches all about records (GET request)                     
     * - "/store"     -> Stores a new about record (POST request)                    
     */
Route::get("/", [HomeScreenController::class, "islame"])->name("islamepage");
Route::get("/aboutpage", [HomeScreenController::class, "aboutpage"])->name("aboutpage");
Route::get("/featurepage", [HomeScreenController::class, "featurepage"])->name("featurepage");
Route::get("/learnepage", [HomeScreenController::class, "learnepage"])->name("learnepage");
Route::get("/blogpage", [HomeScreenController::class, "blogpage"])->name("blogpage");
Route::get("/servics", [HomeScreenController::class, "servicspage"])->name("servicspage");
Route::post('/servics', [ContactMeController::class, 'storeapp'])->name('contact.storeapp');
Route::get('/post/{id}/{tittle}', [HomeScreenController::class, 'post'])->name('post');
Route::get('/qariProfile', [HomeScreenController::class, 'qariProfile'])->name('qariProfile');
Route::post('/store', [HomeScreenController::class, 'storeApp'])->name('store');
Route::get('/store', [HroofVideoController::class, 'store'])->name('store');
Route::get('/DetailQari/{id}', [HomeScreenController::class, 'DetailQari'])->name('DetailQari');
Route::get("/storeapp", [ContactMeController::class, "storeapp"])->name("storeapp");
Route::get('/visits', [HomeScreenController::class, 'getVisitsData']);
Route::get('/set-cookie/{theme}', [HomeScreenController::class, 'setCookie']);
Route::get('/delete-cookie', [HomeScreenController::class, 'deleteCookie']);
Route::get('/quaida-detail/{quaida_id}', [HomeScreenController::class, 'QuaidaDetailApp']);
Route::get('/quran-detail/{quran_id}', [HomeScreenController::class, 'QuranDetailApp']);
Route::get('/quaidaapp/', [HomeScreenController::class, 'QuaidaApp'])->name('quaida-detail');
Route::get('/quranapp/', [HomeScreenController::class, 'QuranApp'])->name('quran');
Route::post('/bookmark', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle');
Route::get('/bookmarks', [BookmarkController::class, 'showBookmarks']);
Route::post('/bookmark/toggle', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle');
############################################################ Start Admin Panel #########################################################################
/**
     * Admin Panel  Routes:
     * - "/"          -> Displays the about page (GET request)                      
     * - "/read"      -> Fetches all about records (GET request)                     
     * - "/store"     -> Stores a new about record (POST request)                    
     * - "/readbyid"  -> Fetches a specific about record by ID (optional) (GET request) 
     * - "/deletebyid"-> Deletes a specific about record by ID (optional) (GET request) 
     */
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::middleware('admindashboard')->group(function () 
{
    Route::get('/send-email', [EmailController::class, 'showForm'])->name('email.form');
    Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('email.send');
    Route::prefix("dashboard")->group(function () 
    {
        Route::get("/", [DashboardController::class, "index"])->name("dashboard");
    });
    Route::prefix("Islameapp")->group(function () 
    {
        Route::get("/", [IslameappController::class, "index"])->name("Islameapp");
        Route::get("/read", [IslameappController::class, "read"])->name("Islameapp.read");
        Route::get("/store", [IslameappController::class, "store"])->name("Islameapp.store");
        Route::get("/readbyid/{id?}", [IslameappController::class, "readById"])->name("Islameapp.readbyid");
        Route::get("/delete/{id?}", [IslameappController::class, "destroy"])->name("Islameapp.delete");
    });
    Route::prefix("about")->group(function () 
    {
        Route::get("/", [AboutController::class, "index"])->name("about");
        Route::get("/read", [AboutController::class, "read"])->name("about.read");
        Route::post("/store", [AboutController::class, "store"])->name("about.store");
        Route::get("/readbyid/{id?}", [AboutController::class, "readById"])->name("about.readbyid");
        Route::get("/deletebyid/{id?}", [AboutController::class, "destroy"])->name("about.deletebyid");
    });
    Route::prefix("Quaida")->group(function () 
    {
        Route::get("/", [QuaidaController::class, "index"])->name("Quaida");
        Route::get("/read", [QuaidaController::class, "read"])->name("Quaida.read");
        Route::get("/store", [QuaidaController::class, "store"])->name("Quaida.store");
        Route::get("/readbyid/{id?}", [QuaidaController::class, "readById"])->name("Quaida.readbyid");
        Route::get("/delete/{id?}", [QuaidaController::class, "destroy"])->name("Quaida.delete");
    });
    Route::prefix("QuaidaDetail")->group(function ()
    {
        Route::get("/", [QuaidaDetailController::class, "index"])->name("QuaidaDetail");
        Route::get("/read", [QuaidaDetailController::class, "read"])->name("QuaidaDetail.read");
        Route::post("/store", [QuaidaDetailController::class, "store"])->name("QuaidaDetail.store");
        Route::get("/readbyid/{id?}", [QuaidaDetailController::class, "readById"])->name("QuaidaDetail.readbyid");
        Route::get("/deletebyid/{id?}", [QuaidaDetailController::class, "destroy"])->name("QuaidaDetail.deletebyid");
    });
    Route::prefix("QuaidaGuaide")->group(function ()
    {
        Route::get("/", [QuaidaGuaideController::class, "index"])->name("QuaidaGuaide");
        Route::get("/read", [QuaidaGuaideController::class, "read"])->name("QuaidaGuaide.read");
        Route::get("/store", [QuaidaGuaideController::class, "store"])->name("QuaidaGuaide.store");
        Route::get("/readbyid/{id?}", [QuaidaGuaideController::class, "readById"])->name("QuaidaGuaide.readbyid");
        Route::get("/delete/{id?}", [QuaidaGuaideController::class, "destroy"])->name("QuaidaGuaide.delete");
    });
    Route::prefix("QuaidaTest")->group(function () 
    {
        Route::get("/", [QuaidaTestController::class, "index"])->name("QuaidaTest");
        Route::get("/read", [QuaidaTestController::class, "read"])->name("QuaidaTest.read");
        Route::post("/store", [QuaidaTestController::class, "store"])->name("QuaidaTest.store");
        Route::get("/readbyid/{id?}", [QuaidaTestController::class, "readById"])->name("QuaidaTest.readbyid");
        Route::get("/deletebyid/{id?}", [QuaidaTestController::class, "destroy"])->name("QuaidaTest.deletebyid");
    });
    Route::prefix("QuaidaAnswer")->group(function () 
    {
        Route::get("/", [QuaidaAnswerController::class, "index"])->name("QuaidaAnswer");
        Route::get("/read", [QuaidaAnswerController::class, "read"])->name("QuaidaAnswer.read");
        Route::get("/store", [QuaidaAnswerController::class, "store"])->name("QuaidaAnswer.store");
        Route::get("/readbyid/{id?}", [QuaidaAnswerController::class, "readById"])->name("QuaidaAnswer.readbyid");
        Route::get("/delete/{id?}", [QuaidaAnswerController::class, "destroy"])->name("QuaidaAnswer.delete");
    });
    Route::prefix("Quran")->group(function () 
    {
        Route::get("/", [QuranController::class, "index"])->name("Quran");
        Route::get("/read", [QuranController::class, "read"])->name("Quran.read");
        Route::get("/store", [QuranController::class, "store"])->name("Quran.store");
        Route::get("/readbyid/{id?}", [QuranController::class, "readById"])->name("Quran.readbyid");
        Route::get("/delete/{id?}", [QuranController::class, "destroy"])->name("Quran.delete");
    });
    Route::prefix("QuranWithAyat")->group(function () 
    {
        Route::get("/", [QuranWithAyatController::class, "index"])->name("QuranWithAyat");
        Route::get("/read", [QuranWithAyatController::class, "read"])->name("QuranWithAyat.read");
        Route::get("/store", [QuranWithAyatController::class, "store"])->name("QuranWithAyat.store");
        Route::get("/readbyid/{id?}", [QuranWithAyatController::class, "readById"])->name("QuranWithAyat.readbyid");
        Route::get("/delete/{id?}", [QuranWithAyatController::class, "destroy"])->name("QuranWithAyat.delete");
    });
    Route::prefix("QuranAyatWithAnswer")->group(function ()
    {
        Route::get("/", [QuranAyatWithAnswerController::class, "index"])->name("QuranAyatWithAnswer");
        Route::get("/read", [QuranAyatWithAnswerController::class, "read"])->name("QuranAyatWithAnswer.read");
        Route::get("/store", [QuranAyatWithAnswerController::class, "store"])->name("QuranAyatWithAnswer.store");
        Route::get("/readbyid/{id?}", [QuranAyatWithAnswerController::class, "readById"])->name("QuranAyatWithAnswer.readbyid");
        Route::get("/delete/{id?}", [QuranAyatWithAnswerController::class, "destroy"])->name("QuranAyatWithAnswer.delete");
    });
    Route::prefix("QuranAyatWithTesting")->group(function () 
    {
        Route::get("/", [QuranAyatWithTestingController::class, "index"])->name("QuranAyatWithTesting");
        Route::get("/read", [QuranAyatWithTestingController::class, "read"])->name("QuranAyatWithTesting.read");
        Route::get("/store", [QuranAyatWithTestingController::class, "store"])->name("QuranAyatWithTesting.store");
        Route::get("/readbyid/{id?}", [QuranAyatWithTestingController::class, "readById"])->name("QuranAyatWithTesting.readbyid");
        Route::get("/delete/{id?}", [QuranAyatWithTestingController::class, "destroy"])->name("QuranAyatWithTesting.delete");
    });  
    Route::prefix("QuranGuaide")->group(function () 
    {
        Route::get("/", [QuranGuaideController::class, "index"])->name("QuranGuaide");
        Route::get("/read", [QuranGuaideController::class, "read"])->name("QuranGuaide.read");
        Route::get("/store", [QuranGuaideController::class, "store"])->name("QuranGuaide.store");
        Route::get("/readbyid/{id?}", [QuranGuaideController::class, "readById"])->name("QuranGuaide.readbyid");
        Route::get("/delete/{id?}", [QuranGuaideController::class, "destroy"])->name("QuranGuaide.delete");
    }); 
    Route::prefix("AdminBlog")->group(function () 
    {
        Route::get("/", [AdminBlogController::class, "index"])->name("AdminBlog");
        Route::get("/read", [AdminBlogController::class, "read"])->name("AdminBlog.read");
        Route::post("/store", [AdminBlogController::class, "store"])->name("AdminBlog.store");
        Route::get("/readbyid/{id?}", [AdminBlogController::class, "readById"])->name("AdminBlog.readbyid");
        Route::get("/deletebyid/{id?}", [AdminBlogController::class, "destroy"])->name("AdminBlog.deletebyid");
    });
    Route::prefix("AdminPost")->group(function () 
    {
        Route::get("/", [AdminPostController::class, "index"])->name("AdminPost");
        Route::get("/read", [AdminPostController::class, "read"])->name("AdminPost.read");
        Route::post("/store", [AdminPostController::class, "store"])->name("AdminPost.store");
        Route::get("/readbyid/{id?}", [AdminPostController::class, "readById"])->name("AdminPost.readbyid");
        Route::get("/deletebyid/{id?}", [AdminPostController::class, "destroy"])->name("AdminPost.deletebyid");
    });
    Route::prefix("ProfileQariSahib")->group(function () 
    {
        Route::get("/", [ProfileQariSahibController::class, "index"])->name("ProfileQariSahib");
        Route::get("/read", [ProfileQariSahibController::class, "read"])->name("ProfileQariSahib.read");
        Route::post("/store", [ProfileQariSahibController::class, "store"])->name("ProfileQariSahib.store");
        Route::get("/readbyid/{id?}", [ProfileQariSahibController::class, "readById"])->name("ProfileQariSahib.readbyid");
        Route::get("/deletebyid/{id?}", [ProfileQariSahibController::class, "destroy"])->name("ProfileQariSahib.deletebyid");
    });
    Route::prefix("QuranWithWord")->group(function () 
    {
        Route::get("/", [QuranWithWordController::class, "index"])->name("QuranWithWord");
        Route::get("/read", [QuranWithWordController::class, "read"])->name("QuranWithWord.read");
        Route::get("/store", [QuranWithWordController::class, "store"])->name("QuranWithWord.store");
        Route::get("/readbyid/{id?}", [QuranWithWordController::class, "readById"])->name("QuranWithWord.readbyid");
        Route::get("/delete/{id?}", [QuranWithWordController::class, "destroy"])->name("QuranWithWord.delete");
    });
    Route::prefix("QuranWordWithTesting")->group(function () 
    {
        Route::get("/", [QuranWordWithTestingController::class, "index"])->name("QuranWordWithTesting");
        Route::get("/read", [QuranWordWithTestingController::class, "read"])->name("QuranWordWithTesting.read");
        Route::get("/store", [QuranWordWithTestingController::class, "store"])->name("QuranWordWithTesting.store");
        Route::get("/readbyid/{id?}", [QuranWordWithTestingController::class, "readById"])->name("QuranWordWithTesting.readbyid");
        Route::get("/delete/{id?}", [QuranWordWithTestingController::class, "destroy"])->name("QuranWordWithTesting.delete");
    });
    Route::prefix("QuranWordWithAnswer")->group(function () 
    {
        Route::get("/", [QuranWordWithAnswerController::class, "index"])->name("QuranWordWithAnswer");
        Route::get("/read", [QuranWordWithAnswerController::class, "read"])->name("QuranWordWithAnswer.read");
        Route::get("/store", [QuranWordWithAnswerController::class, "store"])->name("QuranWordWithAnswer.store");
        Route::get("/readbyid/{id?}", [QuranWordWithAnswerController::class, "readById"])->name("QuranWordWithAnswer.readbyid");
        Route::get("/delete/{id?}", [QuranWordWithAnswerController::class, "destroy"])->name("QuranWordWithAnswer.delete");
    });
    Route::prefix("TestmonialApp")->group(function () 
    {
        Route::get("/", [TestmonialAppController::class, "index"])->name("TestmonialApp");
        Route::get("/read", [TestmonialAppController::class, "read"])->name("TestmonialApp.read");
        Route::post("/store", [TestmonialAppController::class, "store"])->name("TestmonialApp.store");
        Route::get("/readbyid/{id?}", [TestmonialAppController::class, "readById"])->name("TestmonialApp.readbyid");
        Route::get("/deletebyid/{id?}", [TestmonialAppController::class, "destroy"])->name("TestmonialApp.deletebyid");
    });
    Route::prefix("ContactMe")->group(function () 
    {
        Route::get("/", [ContactMeController::class, "index"])->name("ContactMe");
        Route::get("/read", [ContactMeController::class, "read"])->name("ContactMe.read");
        Route::get("/store", [ContactMeController::class, "store"])->name("ContactMe.store");
        Route::get("/readbyid/{id?}", [ContactMeController::class, "readById"])->name("ContactMe.readbyid");
        Route::get("/delete/{id?}", [ContactMeController::class, "destroy"])->name("ContactMe.delete");
    });
    Route::prefix("Visitor")->group(function () 
    {
        Route::get("/", [VistUserController::class, "index"])->name("Visitor");
        Route::get("/read", [VistUserController::class, "read"])->name("Visitor.read");
        Route::get("/store", [VistUserController::class, "store"])->name("Visitor.store");
        Route::get("/readbyid/{id?}", [VistUserController::class, "readById"])->name("Visitor.readbyid");
        Route::get("/delete/{id?}", [VistUserController::class, "destroy"])->name("Visitor.delete");
    });
});


// Route::get('otpregister', [OTPController::class, 'showRegistrationForm'])->name('otpregister');
// Route::post('otpregister', [OTPController::class, 'otpregister']); // Kept as 'otpregister'
// Route::get('otp/verify', [OTPController::class, 'showVerifyForm'])->name('otp.verify');
// Route::post('otp/verify', [OTPController::class, 'verify']);
// Route::get("/", [HomeScreenController::class, "islame"])->name('home');
// Route::get("/test", [HroofVideoController::class, "test"])->name('test');
// Route::middleware('restrictAuthPages')->group(function () {
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [AdminAuthController::class, 'login']);
//     Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
//     Route::post('/register', [AdminAuthController::class, 'register']);
// });
// Route::post('/bookmark', [BookmarkController::class, 'toggleBookmarkQuran'])->name('bookmarkquran.toggle');

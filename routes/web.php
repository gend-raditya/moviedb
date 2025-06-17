<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create')->middleware('auth');

//route untuk menyimpan data
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');
Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movies/{slug}/edit', [MovieController::class, 'edit'])->name('movies.edit')->middleware('auth',RoleAdmin::class);

Route::put('/movies/{slug}', [MovieController::class, 'update'])->name('movies.update');

Route::delete('/movies/{slug}', [MovieController::class, 'destroy'])->name('movies.destroy')->middleware('auth');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');



// routes/web.php
Route::get('/test', function () {
    return view('test');
});

//register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');









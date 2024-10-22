<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\BookingController;
// use App\Http\Controllers\AdminDashboardController;
// use App\Http\Controllers\ProcessController;
// use App\Http\Controllers\PartController;
// use App\Http\Controllers\ShowProcessController;
// use App\Http\Controllers\ClientPartController;
// use App\Http\Controllers\PrintController;
// use App\Http\Controllers\MessageController;
// use App\Http\Controllers\HistoryController;
// use App\Http\Controllers\RatingController; // Include the RatingController
// use App\Http\Controllers\ClientAddedPartsController;


// // Public Routes
// Route::get('/', function () {
//     return view('client.index');
// });

// // Authenticated Routes
// Route::middleware(['auth'])->group(function () {
//     // Dashboard Route
//     Route::get('/dashboard', [BookingController::class, 'showDashboard'])->name('dashboard');

//     // Booking Routes
//     Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
//     Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
//     Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
//     Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

//     // Sidebar Link Routes
//     Route::view('/book', 'book')->name('book');
//     Route::view('/maintenance', 'maintenance')->name('maintenance');
//     Route::view('/notification', 'notification')->name('notification');
//     Route::view('/payment', 'payment')->name('payment');

//     // Profile Routes
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::put('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage'); // Route for uploading profile image

//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::delete('/parts/{id}/decline', [ClientPartController::class, 'decline'])->name('parts.decline');


//     // Customer Support Routes
//     Route::get('/customer-support', [MessageController::class, 'showForm'])->name('customer.support');
//     Route::post('/customer-support', [MessageController::class, 'store'])->name('customer.support.store');

//     // Rating Routes
//     Route::view('/ratings', 'ratings')->name('ratings'); // View to show the rating form
//     Route::post('/ratings/store', [RatingController::class, 'store'])->name('ratings.store'); // Store rating

//     Route::get('/client/added-parts', [ClientAddedPartsController::class, 'index'])->name('client.added.parts.index');
//     // Route::get('/client-added-parts', [ClientAddedPartsController::class, 'index'])->name('client.added.parts');
//     Route::get('/client/added-parts', [ClientAddedPartsController::class, 'index'])->name('client.added.parts');


// });

// // Admin Routes
// Route::middleware(['auth', 'admin'])->group(function () {
//     // Admin Dashboard
//     Route::get('admin/dashboard', [RoleController::class, 'index'])->name('admin.dashboard');

//     // Admin User Management
//     Route::get('/admin/users', [AdminDashboardController::class, 'showUsers'])->name('admin.users');

//     // Admin Pages
//     Route::view('admin/tables', 'admin.tables')->name('admin.tables');
//     Route::view('/admin/process', 'admin.process')->name('admin.process');
//     Route::view('/admin/done-car', 'admin.done-car')->name('admin.done-car');

//     // User Statistics
//     Route::get('/user-statistics', [AdminDashboardController::class, 'showUserStatistics'])->name('user.statistics');

//     // Parts Management
//     Route::get('/admin/createparts', [PartController::class, 'create'])->name('admin.createparts');
//     Route::post('/admin/storeparts', [PartController::class, 'store'])->name('parts.store');
//     Route::resource('parts', PartController::class);

//     // Inprocess Management
//     Route::get('/admin/inprocess', [ShowProcessController::class, 'index'])->name('admin.inprocess');
//     Route::post('/client/parts/store', [ClientPartController::class, 'store'])->name('client.parts.store');
//     Route::put('/process/{id}/done', [ProcessController::class, 'markAsDone'])->name('process.done');

//     // Client Parts Store
//     Route::post('/process/{id}/done', [ProcessController::class, 'markAsDone'])->name('process.done');
//     Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    
//     // printcontroller
//     Route::get('/client-parts/{processId}', [PrintController::class, 'getClientParts']);
// });

// // Auth Routes
// require __DIR__ . '/auth.php';

// // Additional Admin Booking Management
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
//     Route::post('/process-booking/{id}', [ProcessController::class, 'process'])->name('admin.process.booking');
// });
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ShowProcessController;
use App\Http\Controllers\ClientPartController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CardDashboardController;
use App\Http\Controllers\PaymentController;

// Public Routes
Route::get('/', function () {
    return view('client.index');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CardDashboardController::class, 'showDashboard'])->name('dashboard');

    // Booking Routes
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    // Sidebar Link Routes
    Route::view('/book', 'book')->name('book');
    Route::view('/maintenance', 'maintenance')->name('maintenance');
    Route::view('/notification', 'notification')->name('notification');
    Route::view('/payment', 'payment')->name('payment');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Parts Decline Route
    Route::delete('/parts/{id}/decline', [ClientPartController::class, 'decline'])->name('parts.decline');

    // Customer Support Routes
    Route::get('/customer-support', [MessageController::class, 'showForm'])->name('customer.support');
    Route::post('/customer-support', [MessageController::class, 'store'])->name('customer.support.store');

    // Rating Routes
    Route::view('/ratings', 'ratings')->name('ratings');
    Route::post('/ratings/store', [RatingController::class, 'store'])->name('ratings.store');

    // Client Added Parts Route
    Route::get('/client/added-parts', [CardDashboardController::class, 'index'])->name('client.added.parts.index');

    // Payment Routes
    Route::get('/payment', [PaymentController::class, 'showPayment'])->name('payment.show');
    Route::post('processes/{id}/upload-proof', [ProcessController::class, 'uploadProof'])->name('processes.uploadProof');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [RoleController::class, 'index'])->name('admin.dashboard');

    // Admin User Management
    Route::get('/admin/users', [AdminDashboardController::class, 'showUsers'])->name('admin.users');

    // Admin Pages
    Route::view('admin/tables', 'admin.tables')->name('admin.tables');
    Route::view('/admin/process', 'admin.process')->name('admin.process');
    Route::view('/admin/done-car', 'admin.done-car')->name('admin.done-car');

    // User Statistics
    Route::get('/user-statistics', [AdminDashboardController::class, 'showUserStatistics'])->name('user.statistics');

    // Parts Management
    Route::get('/admin/createparts', [PartController::class, 'create'])->name('admin.createparts');
    Route::post('/admin/storeparts', [PartController::class, 'store'])->name('parts.store');
    Route::resource('parts', PartController::class);

    // In-process Management
    Route::get('/admin/inprocess', [ShowProcessController::class, 'index'])->name('admin.inprocess'); // Only keep this route
    Route::post('/client/parts/store', [ClientPartController::class, 'store'])->name('client.parts.store');
    Route::put('/process/{id}/done', [ProcessController::class, 'markAsDone'])->name('process.done');

    // Print Controller
    Route::get('/client-parts/{processId}', [PrintController::class, 'getClientParts']);
});

// Auth Routes
require __DIR__ . '/auth.php';

// Additional Admin Booking Management
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/process-booking/{id}', [ProcessController::class, 'process'])->name('admin.process.booking');
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

});

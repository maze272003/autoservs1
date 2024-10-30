<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    RoleController,
    BookingController,
    AdminDashboardController,
    ProcessController,
    PartController,
    ShowProcessController,
    ClientPartController,
    PrintController,
    MessageController,
    HistoryController,
    RatingController,
    CardDashboardController,
    PaymentController,
    HistoryBookingController,
    ResponseMessageController
};
use App\Http\Controllers\StatisticsController;

// Public Routes
// Display the client index page
Route::get('/', function () {
    return view('client.index');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard Route
    // Show the main dashboard for authenticated users
    Route::get('/dashboard', [CardDashboardController::class, 'showDashboard'])->name('dashboard');

    // Booking Routes
    // CRUD operations for bookings
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    // Sidebar Link Routes
    // Direct links to various user views
    Route::view('/book', 'book')->name('book');
    Route::view('/maintenance', 'maintenance')->name('maintenance');
    Route::view('/notification', 'notification')->name('notification');
    Route::view('/payment', 'payment')->name('payment');

    // Profile Routes
    // Manage user profile details
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Parts Decline Route
    // Decline added parts
    Route::delete('/parts/{id}/decline', [ClientPartController::class, 'decline'])->name('parts.decline');

    // Customer Support Routes
    // Show and store customer support messages
    Route::get('/customer-support', [MessageController::class, 'showForm'])->name('customer.support');
    Route::post('/customer-support', [MessageController::class, 'store'])->name('customer.support.store');

    // Rating Routes
    // Submit and view user ratings
    Route::view('/ratings', 'ratings')->name('ratings');
    Route::post('/ratings/store', [RatingController::class, 'store'])->name('ratings.store');

    // Client Added Parts Route
    // Show parts added by client
    Route::get('/client/added-parts', [CardDashboardController::class, 'index'])->name('client.added.parts.index');

    // Payment Routes
    // Payment processing routes
    Route::get('/payment', [PaymentController::class, 'showPayment'])->name('payment.show');
    Route::post('processes/{id}/upload-proof', [ProcessController::class, 'uploadProof'])->name('processes.uploadProof');

    // Notification Routes
    // Show and delete notifications
    Route::get('/notifications', [MessageController::class, 'showNotifications'])->name('notifications');
    Route::post('/messages/delete', [MessageController::class, 'deleteMessages'])->name('messages.delete');

    // Maintenance History Routes
    // Show maintenance history for authenticated users
    Route::get('/maintenance/history', [HistoryBookingController::class, 'showMaintenanceHistory'])->name('maintenance.history');
    Route::get('/client/history/maintenance', [HistoryBookingController::class, 'clientMaintenanceHistory'])->name('ClientHistory.maintenanceHistory');

    // Client Messages Routes
    // View and reply to client messages
    Route::get('/client/notifications', [MessageController::class, 'showNotifications'])->name('client.notifications');
    Route::get('/client/messages/{id}/replies', [ResponseMessageController::class, 'getReplies'])->name('client.messages.replies');
    Route::get('/client/notifications', [MessageController::class, 'showNotifications'])->name('messages.notification');

    // client new added routes start
    Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('admin.userStatistics');
Route::get('/admin/statistics/data', [StatisticsController::class, 'fetchChartData'])->name('admin.userStatistics.data');
    // client new added routes end
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Dashboard Route
    // Display admin dashboard
    Route::get('admin/dashboard', [RoleController::class, 'index'])->name('admin.dashboard');

    // Admin User Management Routes
    // CRUD operations for admin users
    Route::get('/admin/users', [AdminDashboardController::class, 'showUsers'])->name('admin.users');
    Route::get('/admin/users/create', [AdminDashboardController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminDashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');

    // Admin Notification Routes
    // Display admin notifications
    Route::get('/admin/notifications', [MessageController::class, 'showAdminNotifications'])->name('admin.notifications');

    // Admin Pages
    // Direct links to various admin pages
    Route::view('admin/tables', 'admin.tables')->name('admin.tables');
    Route::view('/admin/process', 'admin.process')->name('admin.process');
    Route::view('/admin/done-car', 'admin.done-car')->name('admin.done-car');

    // User Statistics Routes
    // Show user and released parts statistics
    Route::get('/user-statistics', [AdminDashboardController::class, 'showUserStatistics'])->name('user.statistics');
    Route::get('/admin/released-parts-statistics', [AdminDashboardController::class, 'showReleasedPartsStatistics'])->name('admin.releasedPartsStatistics');
    Route::get('/admin/user-statistics', [AdminDashboardController::class, 'showReleasedPartsStatistics'])->name('admin.userStatistics');

    // Parts Management Routes
    // Manage parts and associated actions
    Route::get('/admin/createparts', [PartController::class, 'create'])->name('admin.createparts');
    Route::post('/admin/storeparts', [PartController::class, 'store'])->name('parts.store');
    Route::resource('parts', PartController::class);

    // In-process Management Routes
    // Display and manage in-process records
    Route::get('/admin/inprocess', [ShowProcessController::class, 'index'])->name('admin.inprocess');
    Route::post('/client/parts/store', [ClientPartController::class, 'store'])->name('client.parts.store');
    Route::put('/process/{id}/done', [ProcessController::class, 'markAsDone'])->name('process.done');
    Route::delete('/admin/processes/{processId}/delete-part/{partId}', [ProcessController::class, 'deletePart'])->name('processes.deletePart');

    // Print Parts for Client
    // Print controller for client parts based on process
    Route::get('/client-parts/{processId}', [PrintController::class, 'getClientParts']);

    // Response Message Management
    // Manage admin responses to messages
    Route::get('/admin/response-messages', [ResponseMessageController::class, 'index'])->name('admin.response.messages');
    Route::post('/admin/replies/store', [ResponseMessageController::class, 'storeReply'])->name('admin.store.reply');
    Route::delete('/admin/messages/{id}', [ResponseMessageController::class, 'deleteMessage'])->name('admin.messages.delete');
    Route::post('/admin/messages/reply', [ResponseMessageController::class, 'reply'])->name('admin.messages.reply');

    // Admin Feedback Management
    // View and delete feedback
    Route::get('/admin/feedback', [RatingController::class, 'index'])->name('admin.feedback.index');
    Route::delete('/admin/feedback/{id}', [RatingController::class, 'destroy'])->name('admin.feedback.destroy');

    // admin new added routes start

    // admin new added routes end
});

// Auth Routes (Generated)
require __DIR__ . '/auth.php';

// Additional Admin Booking Management Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Booking and History Management
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/process-booking/{id}', [ProcessController::class, 'process'])->name('admin.process.booking');
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Route to display the main user statistics with charts and client parts
    Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('admin.statistics');

    // Route to display only the client parts list
    Route::get('/client-parts', [StatisticsController::class, 'showClientParts'])->name('client.parts');
});
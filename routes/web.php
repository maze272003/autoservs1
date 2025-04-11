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

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('client.index');
});

// ==================== AUTHENTICATED USER ROUTES ====================
Route::middleware(['auth'])->group(function () {
    // -------------------- Dashboard --------------------
    Route::get('/dashboard', [CardDashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('admin/dashboard', [RoleController::class, 'user'])->name('dashboard');
    
    // -------------------- Booking Management --------------------
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    
    // -------------------- Sidebar Navigation --------------------
    Route::view('/book', 'book')->name('book');
    Route::view('/maintenance', 'maintenance')->name('maintenance');
    Route::view('/notification', 'notification')->name('notification');
    Route::view('/payment', 'payment')->name('payment');
    
    // -------------------- Profile Management --------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // -------------------- Parts Management --------------------
    Route::delete('/parts/{id}/decline', [ClientPartController::class, 'decline'])->name('parts.decline');
    Route::get('/client/added-parts', [CardDashboardController::class, 'index'])->name('client.added.parts.index');
    
    // -------------------- Customer Support --------------------
    Route::get('/customer-support', [MessageController::class, 'showForm'])->name('customer.support');
    Route::post('/customer-support', [MessageController::class, 'store'])->name('customer.support.store');
    
    // -------------------- Ratings & Feedback --------------------
    Route::view('/ratings', 'ratings')->name('ratings');
    Route::post('/ratings/store', [RatingController::class, 'store'])->name('ratings.store');
    
    // -------------------- Payment Processing --------------------
    Route::get('/payment', [PaymentController::class, 'showPayment'])->name('payment.show');
    Route::post('processes/{id}/upload-proof', [ProcessController::class, 'uploadProof'])->name('processes.uploadProof');
    
    // -------------------- Notifications --------------------
    Route::get('/notifications', [MessageController::class, 'showNotifications'])->name('notifications');
    Route::get('/client/notifications', [MessageController::class, 'showNotifications'])->name('client.notifications');
    Route::get('/client/notifications', [MessageController::class, 'showNotifications'])->name('messages.notification');
    Route::post('/messages/delete', [MessageController::class, 'deleteMessages'])->name('messages.delete');
    
    // -------------------- Message Replies --------------------
    Route::get('/client/messages/{id}/replies', [ResponseMessageController::class, 'getReplies'])->name('client.messages.replies');
    
    // -------------------- Maintenance History --------------------
    Route::get('/maintenance/history', [HistoryBookingController::class, 'showMaintenanceHistory'])->name('maintenance.history');
    Route::get('/client/history/maintenance', [HistoryBookingController::class, 'clientMaintenanceHistory'])->name('ClientHistory.maintenanceHistory');

    Route::get('/api/card-stats', function() {
        return response()->json([
            'added_parts' => \App\Models\ClientPart::count(),
            'pending_car' => \App\Models\Booking::where('status', 'pending')->count(),
            'canceled_book' => \App\Models\Booking::where('status', 'canceled')->count(),
            'in_process' => \App\Models\Process::count()
        ]);
    });
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'admin'])->group(function () {
    // -------------------- Admin Dashboard --------------------
    Route::get('admin/dashboard', [RoleController::class, 'admin'])->name('admin.dashboard');
    
    // -------------------- Admin Views --------------------
    Route::view('admin/tables', 'admin.tables')->name('admin.tables');
    Route::view('/admin/process', 'admin.process')->name('admin.process');
    Route::view('/admin/done-car', 'admin.done-car')->name('admin.done-car');
    
    // -------------------- User Management --------------------
    Route::get('/admin/users', [AdminDashboardController::class, 'showUsers'])->name('admin.users');
    Route::get('/admin/users/create', [AdminDashboardController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminDashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    
    // -------------------- Parts Management --------------------
    Route::get('/admin/createparts', [PartController::class, 'create'])->name('admin.createparts');
    Route::post('/admin/storeparts', [PartController::class, 'store'])->name('parts.store');
    Route::resource('parts', PartController::class);
    
    // -------------------- Process Management --------------------
    Route::get('/admin/inprocess', [ShowProcessController::class, 'index'])->name('admin.inprocess');
    Route::post('/client/parts/store', [ClientPartController::class, 'store'])->name('client.parts.store');
    Route::put('/process/{id}/done', [ProcessController::class, 'markAsDone'])->name('process.done');
    Route::delete('/admin/processes/{processId}/delete-part/{partId}', [ProcessController::class, 'deletePart'])->name('processes.deletePart');
    
    // -------------------- Booking Management --------------------
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/process-booking/{id}', [ProcessController::class, 'process'])->name('admin.process.booking');
    
    // -------------------- History Management --------------------
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    
    // -------------------- Notifications & Messages --------------------
    Route::get('/admin/notifications', [MessageController::class, 'showAdminNotifications'])->name('admin.notifications');
    Route::get('/admin/response-messages', [ResponseMessageController::class, 'index'])->name('admin.response.messages');
    Route::post('/admin/replies/store', [ResponseMessageController::class, 'storeReply'])->name('admin.store.reply');
    Route::delete('/admin/messages/{id}', [ResponseMessageController::class, 'deleteMessage'])->name('admin.messages.delete');
    Route::post('/admin/messages/reply', [ResponseMessageController::class, 'reply'])->name('admin.messages.reply');
    
    // -------------------- Feedback Management --------------------
    Route::get('/admin/feedback', [RatingController::class, 'index'])->name('admin.feedback.index');
    Route::delete('/admin/feedback/{id}', [RatingController::class, 'destroy'])->name('admin.feedback.destroy');
    
    // -------------------- Statistics & Reporting --------------------
    Route::get('/user-statistics', [AdminDashboardController::class, 'showUserStatistics'])->name('user.statistics');
    Route::get('/admin/released-parts-statistics', [AdminDashboardController::class, 'showReleasedPartsStatistics'])->name('admin.releasedPartsStatistics');
    Route::get('/admin/user-statistics', [AdminDashboardController::class, 'showReleasedPartsStatistics'])->name('admin.userStatistics');
    Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('admin.statistics');
    Route::get('/admin/statistics/data', [StatisticsController::class, 'fetchChartData'])->name('admin.userStatistics.data');
    Route::get('/client-parts', [StatisticsController::class, 'showClientParts'])->name('client.parts');
    Route::get('/client-parts/{processId}', [PrintController::class, 'getClientParts']);
    
    // -------------------- Profile Management --------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== AUTHENTICATION ROUTES ====================
require __DIR__ . '/auth.php';
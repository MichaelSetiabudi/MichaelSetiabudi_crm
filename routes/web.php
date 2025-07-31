<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Lead Management Routes
    Route::resource('leads', LeadController::class);
    Route::post('leads/{lead}/assign', [LeadController::class, 'assign'])->name('leads.assign');
    Route::get('leads/download/pdf', [LeadController::class, 'downloadPdf'])->name('leads.download-pdf');
    
    // Product Management Routes
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    
    // Project Management Routes
    Route::resource('projects', ProjectController::class);
    Route::get('projects-approval', [ProjectController::class, 'approvalQueue'])->name('projects.approval-queue');
    Route::patch('projects/{project}/approve', [ProjectController::class, 'approve'])->name('projects.approve');
    Route::patch('projects/{project}/reject', [ProjectController::class, 'reject'])->name('projects.reject');
    Route::get('all-projects', [ProjectController::class, 'allProjects'])->name('projects.all');
    Route::get('all-projects/pdf', [ProjectController::class, 'downloadPDF'])->name('projects.pdf');
    
    // Customer Management Routes
    Route::resource('customers', CustomerController::class);
    Route::get('customers/{customer}/services', [CustomerController::class, 'services'])->name('customers.services');
    Route::post('customers/{customer}/add-service', [CustomerController::class, 'addService'])->name('customers.add-service');
    
    // Reports Routes
    Route::get('reports', function () {
        return view('reports.index');
    })->name('reports.index');
    
    // Notifications Routes
    Route::get('notifications', function () {
        return view('notifications.index');
    })->name('notifications.index');
});

require __DIR__.'/auth.php';

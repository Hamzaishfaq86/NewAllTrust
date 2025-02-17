<?php

// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\FptController;
use App\Http\Controllers\admin\LeadController;
use App\Http\Controllers\admin\DmsController;
use App\Http\Controllers\MarketManagementController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\OffShoreController;
use App\Http\Controllers\TwoStepVerificationController;
use App\Http\Controllers\DocumentController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|two-step.verify
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [\App\Http\Controllers\admin\AdminController::class, 'index'])->name('dashboard');


Route::get('/toggle-email-notification', [App\Http\Controllers\admin\UserController::class, 'toggleEmailNotification'])->name('toggle.email.notification');

Route::get('/user',[\App\Http\Controllers\admin\UserController::class,'index'])->name('user');
Route::post('/user-store',[\App\Http\Controllers\admin\UserController::class,'store'])->name('user-store');
Route::post('/user-update/{id}', [\App\Http\Controllers\admin\UserController::class, 'update'])->name('user-update');
Route::get('/user-delete/{id}', [\App\Http\Controllers\admin\UserController::class, 'delete'])->name('user-delete');
// Corrected routes
Route::get('/ticket', [\App\Http\Controllers\admin\TicketController::class, 'index'])->name('ticket');
Route::post('/ticket-store', [\App\Http\Controllers\admin\TicketController::class, 'store'])->name('ticket-store');
Route::put('/ticket-update/{id}', [\App\Http\Controllers\admin\TicketController::class, 'update'])->name('ticket-update'); // Changed to PUT
Route::get('/ticket-delete/{id}', [\App\Http\Controllers\admin\TicketController::class, 'delete'])->name('ticket-delete');

Route::get('/support', [\App\Http\Controllers\admin\SupportController::class, 'index'])->name('support');
Route::post('/support-store', [\App\Http\Controllers\admin\SupportController::class, 'store'])->name('support-store');
Route::put('/support-update/{id}', [\App\Http\Controllers\admin\SupportController::class, 'update'])->name('support-update');
Route::get('/support-delete/{id}', [\App\Http\Controllers\admin\SupportController::class, 'delete'])->name('support-delete');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/faq-view', [FaqController::class, 'indexView'])->name('faq.view');
Route::post('/faq-store', [FaqController::class, 'store'])->name('faq-store');
Route::post('/faq-update/{id}', [FaqController::class, 'update'])->name('faq-update');
Route::get('/faq-delete/{id}', [FaqController::class, 'destroy'])->name('faq-delete');



Route::get('/new-adviser', [\App\Http\Controllers\admin\NewAdviserController::class, 'create'])->name('newAdviser');

Route::post('/newAdviser-store', [\App\Http\Controllers\admin\NewAdviserController::class, 'store'])->name('newAdviser-store');
Route::get('/newAdviser-edit/{id}', [\App\Http\Controllers\admin\NewAdviserController::class, 'edit'])->name('newAdviser-edit');
Route::post('/newAdviser-update/{id}', [\App\Http\Controllers\admin\NewAdviserController::class, 'update'])->name('newAdviser-update');
Route::any('/newAdviser-delete/{id}', [\App\Http\Controllers\admin\NewAdviserController::class, 'destroy'])->name('newAdviser-delete');
Route::get('/deletedAdvisers', [\App\Http\Controllers\admin\NewAdviserController::class, 'deleted'])->name('deletedAdvisers');
Route::get('/adviser/view/{id}', [\App\Http\Controllers\admin\NewAdviserController::class, 'view'])->name('newAdviser-view');


Route::get('/new-adviser-pending', [\App\Http\Controllers\admin\NewAdviserController::class, 'pending'])->name('newAdviser-pending');
Route::get('/new-adviser-existing', [\App\Http\Controllers\admin\NewAdviserController::class, 'existing'])->name('newAdviser-existing');
Route::get('/newAdviser-shows/{id}', [\App\Http\Controllers\admin\NewAdviserController::class, 'show'])->name('newAdviser-show');
Route::get('/chenge-status-adviser/{id}/{status}', [\App\Http\Controllers\admin\NewAdviserController::class, 'pendingadviser'])->name('adviser-pending');
Route::post('/adviser/restore/{id}', [\App\Http\Controllers\admin\NewAdviserController::class, 'restore'])->name('adviser-restore');
Route::get('adviser-declined-list',[\App\Http\Controllers\admin\NewAdviserController::class, 'declinedList'])->name('adviser.declinedList');



Route::get('/new-offshore', [OffShoreController::class, 'create'])->name('newOffshore');
Route::post('/newOffshore-store', [OffShoreController::class, 'store'])->name('newOffshore-store');
Route::get('/newoffshore-edit/{id}', [OffShoreController::class, 'edit'])->name('newoffshore-edit');
Route::post('/newoffshore-update/{id}', [OffShoreController::class, 'update'])->name('newoffshore-update');
Route::any('/newoffshore-delete/{id}', [OffShoreController::class, 'destroy'])->name('newoffshore-delete');
Route::get('/deletedoffshore', [OffShoreController::class, 'deleted'])->name('deletedoffshore');
Route::get('/adviser/view/{id}', [OffShoreController::class, 'view'])->name('newAdviseroffshore');
Route::get('/newAdviser-show/{id}', [OffShoreController::class, 'show'])->name('newoffshore-show');
Route::get('/chenge-status-offshore/{id}/{status}', [OffShoreController::class, 'pendingoffadviser'])->name('offshore-pending');
Route::get('/new-offshore-existing/{id}', [OffShoreController::class, 'existingStatus'])->name('offshore-existing');
Route::post('/offshore/restore/{id}', [OffShoreController::class, 'restore'])->name('offshore-restore');

Route::post('offsore-country-store',[OffShoreController::class, 'country_store'])->name('offshore.countryStore');
Route::get('offsore-pending-list',[OffShoreController::class, 'pendingList'])->name('offshore.pendingList');
Route::get('offsore-existing-list',[OffShoreController::class, 'existingList'])->name('offshore.existingList');

Route::get('/advisers/existing/{id}', [OffShoreController::class, 'showExisting'])->name('existing-page');

// Route to show declined advisers
Route::get('/advisers/declined/{id}', [OffShoreController::class, 'showDeclined'])->name('declined-page');
Route::get('offsore-declined-list',[OffShoreController::class, 'declinedList'])->name('offshore.declinedList');
Route::get('/new-offshore-declined/{id}', [OffShoreController::class, 'declinedStatus'])->name('offshore-declined');


Route::get('/admin/leads', [LeadController::class, 'index'])->name('leads.index');
Route::post('/admin/leads/store', [LeadController::class, 'store'])->name('leads.store');

Route::any('/admin/leads/{id}/update', [LeadController::class, 'update'])->name('leads.update');
Route::get('leads-delete/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');
Route::get('/reports', [\App\Http\Controllers\admin\ReportController::class, 'index'])->name('report.index');
Route::get('/mail', [MarketManagementController::class, 'mailIndex'])->name('mail.index');


Route::get('/members-before', [\App\Http\Controllers\admin\MemberController::class, 'membersBefore'])->name('members-before');
Route::get('/members-before2', [\App\Http\Controllers\admin\MemberController::class, 'membersBefore2'])->name('members-before2');
Route::get('/members-before3', [\App\Http\Controllers\admin\MemberController::class, 'membersBefore3'])->name('members-before3');


Route::get('/create-members-oasis', [\App\Http\Controllers\admin\MemberController::class, 'members'])->name('members-oasis-create');
Route::get('/create-members-Sipp', [\App\Http\Controllers\admin\MemberController::class, 'memberSipp'])->name('member-sipp-create');
Route::get('/create-members-Sipp-full', [\App\Http\Controllers\admin\MemberController::class, 'memberSippFull'])->name('member-sipp-full-create');

Route::post('/create-members-store', [\App\Http\Controllers\admin\MemberController::class, 'memberStore'])->name('members.oasis.store');
Route::get('/pending-members', [\App\Http\Controllers\admin\MemberController::class, 'membersPending'])->name('members.oasis.pending');
Route::get('/existing-members', [\App\Http\Controllers\admin\MemberController::class, 'memberExisting'])->name('members.oasis.existing');

Route::get('/members-oasis-edit/{id}', [\App\Http\Controllers\admin\MemberController::class, 'memberedit'])->name('members-oasis-edit');
Route::post('/members-oasis-update', [\App\Http\Controllers\admin\MemberController::class, 'memberUpdate'])->name('members.oasis.update');
Route::get('/members-oasis-view/{id}', [\App\Http\Controllers\admin\MemberController::class, 'memberViewSpecific'])->name('members-oasis-view');
Route::delete('/members/delete/{id}', [\App\Http\Controllers\admin\MemberController::class, 'destroy'])->name('members-delete');
Route::get('/change-status-member/{id}/{status}', [\App\Http\Controllers\admin\MemberController::class, 'pendingamember'])->name('member-pending');

Route::get('/members-detail', [\App\Http\Controllers\admin\MemberController::class, 'membersDetails'])->name('members-details');

Route::get('/add-members-detail', [\App\Http\Controllers\admin\MemberController::class, 'addmembersDetails'])->name('add-member-detail');
Route::post('/members-detail-store', [\App\Http\Controllers\admin\MemberController::class, 'membersDetailstore'])->name('member-detail-store');
Route::get('/members-detail-edit/{id}', [\App\Http\Controllers\admin\MemberController::class, 'membersDetailsEdit'])->name('members-details-edit');
Route::post('/members-detail-update/{id}', [\App\Http\Controllers\admin\MemberController::class, 'membersDetailsUpdate'])->name('members-details-update');
Route::get('/members-detail-view/{id}', [\App\Http\Controllers\admin\MemberController::class, 'membersDetailsView'])->name('members-details-view');
Route::get('/members-detail-view-ftp/{id}', [\App\Http\Controllers\admin\MemberController::class, 'membersDetailsViewftp'])->name('members-details-view-ftp');
Route::get('/members-detail-delete/{id}', [\App\Http\Controllers\admin\MemberController::class, 'membersDetailsDelete'])->name('member-details-delete');
Route::put('/member-restore/{id}', [\App\Http\Controllers\admin\MemberController::class, 'restoreMember'])->name('member-restore');

// Route::get('/member/deleted', [\App\Http\Controllers\admin\MemberController::class, 'showDeletedMember'])->name('member-deleted'); // View soft deleted posts



Route::get('/create-fpt', [FptController::class, 'fptCreate'])->name('fpt-create');
Route::get('/show-fpt', [FptController::class, 'showFpt'])->name('ahow-fpt');
Route::get('/view-fpt/{id}', [FptController::class, ' fptView'])->name('fpt-view');
Route::any('/fpt-store', [FptController::class, 'fptStore'])->name('fpt-store');
// Restore soft deleted FPT member
Route::put('/fpt-restore/{id}', [\App\Http\Controllers\admin\FptController::class, 'restoreFpt'])->name('fpt-restore');


// Fpt soft delete =====
Route::any('/fpt-delete/{id}', [\App\Http\Controllers\admin\FptController::class, 'destroy'])->name('fpt-delete');
Route::get('/deletedfpt', [\App\Http\Controllers\admin\FptController::class, 'deleted'])->name('deletedfpt');


Route::get('/fpt-list', [FptController::class, 'getfptList']);
Route::get('/admin/delete-fpt/{id}', [FptController::class, 'deleteFPT']);
Route::get('/admin/view-fpt/{id}', [FptController::class, 'viewFPT'])->name('fptt-view');
Route::get('/admin/edit-fpt/{id}', [FptController::class, 'editFPT'])->name('fptt-edit');
Route::post('/admin/update-fpt/{id}', [FptController::class, 'fptUpdate']);
Route::get('/change-status-ftp/{id}/{status}', [FptController::class, 'pendingftp'])->name('fpt-pending');

Route::delete('/members/{id}', [\App\Http\Controllers\admin\MemberController::class, 'destroy'])->name('members.delete');

// Route to display deleted members
Route::get('/deletedMembers', [\App\Http\Controllers\admin\MemberController::class, 'deleted'])->name('deleted.members');
Route::get('member-declined-list',[\App\Http\Controllers\admin\MemberController::class, 'declinedList'])->name('member.declinedList');

// ============ DMS ===
Route::get('/dms', [DmsController::class, 'index'])->name('dms.index');
Route::get('/dms-create', [DmsController::class, 'create'])->name('dms.create');
Route::post('/dms/update/{id}', [DmsController::class, 'update'])->name('dms.update');
Route::post('/dms/store', [DmsController::class, 'store'])->name('dms.store');
Route::get('/dms-delete/{id}', [DmsController::class, 'delete'])->name('dms.delete');
Route::get('/dms-edit/{id}', [DmsController::class, 'edit'])->name('dms.edit');
Route::post('/dms/{id}', [DmsController::class, 'store'])->name('dms.update');


Route::get('documents/{id}', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::POST('documents/update', [DocumentController::class, 'update'])->name('documents.update');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/comment/{id}', [CommentController::class, 'index'])->name('comment.index');
Route::post('/comment-store', [CommentController::class, 'store'])->name('comment.store');
Route::post('/comment-update', [CommentController::class, 'update'])->name('comment.update');
Route::any('/comment-delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

Route::get('/two-step-verify', [TwoStepVerificationController::class, 'showVerifyForm'])->name('two-step.verify');
Route::post('/two-step-verify', [TwoStepVerificationController::class, 'verify']);

Route::get('/two-step-verify', [TwoStepVerificationController::class, 'showVerifyForm'])->name('two-step.verify');
Route::post('/two-step-verify', [TwoStepVerificationController::class, 'verify'])->name('verify-step');
Route::get('/resend-code', [TwoStepVerificationController::class, 'resendCode'])->name('resend-code');

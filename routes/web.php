<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\PageController::class, 'index'])->name('home');

    Route::resource('user', \App\Http\Controllers\UserController::class)
        ->except(['show', 'edit', 'create'])
        ->middleware(['role:admin']);

    Route::middleware(['auth', 'check.jabatan:1'])->group(function () {
        Route::resource('jabatan', \App\Http\Controllers\JabatanController::class);
        Route::resource('bagian', \App\Http\Controllers\BagianController::class);
        Route::resource('jenis', \App\Http\Controllers\JenisSuratController::class);
        Route::resource('relasi', \App\Http\Controllers\RelasiController::class);
        Route::resource('ruang', \App\Http\Controllers\RuangPenyimpananController::class);
        // Route::resource('suratmasuk', \App\Http\Controllers\SuratMasukController::class);
        Route::post('suratmasuk/uploadfile/{id}', [\App\Http\Controllers\SuratMasukController::class, 'uploadFile'])
            ->name('suratmasuk.uploadfile');
        Route::post('/suratmasuk/store-disposisi', [\App\Http\Controllers\SuratMasukController::class, 'storeDisposisi'])
            ->name('suratmasuk.storeDisposisi');

        // Route::resource('suratkeluar', \App\Http\Controllers\SuratKeluarController::class);
        Route::post('suratkeluar/uploadfile/{id}', [\App\Http\Controllers\SuratKeluarController::class, 'uploadFile'])
            ->name('suratkeluar.uploadfile');
    });

    Route::middleware(['auth', 'check.jabatan:1,2,3'])->group(function () {
        Route::resource('suratmasuk', \App\Http\Controllers\SuratMasukController::class);
    });

    Route::middleware(['auth', 'check.jabatan:1,3'])->group(function () {
        Route::resource('suratkeluar', \App\Http\Controllers\SuratKeluarController::class);
        Route::get('approve', [\App\Http\Controllers\SuratKeluarController::class, 'persetujuan'])
            ->name('approve.index');
        Route::post('approve/setuju/{id}', [\App\Http\Controllers\SuratKeluarController::class, 'setuju'])
            ->name('approve.setuju');
        Route::post('approve/tolak/{id}', [\App\Http\Controllers\SuratKeluarController::class, 'tolak'])
            ->name('approve.tolak');
    });

    Route::middleware(['auth', 'check.jabatan:1,2'])->group(function () {
        Route::get('pdisposisi', [\App\Http\Controllers\SuratMasukController::class, 'persetujuan'])
            ->name('pdisposisi.index');
        Route::post('pdisposisi/setuju/{id}', [\App\Http\Controllers\SuratMasukController::class, 'setuju'])
            ->name('pdisposisi.setuju');
        Route::post('pdisposisi/tolak/{id}', [\App\Http\Controllers\SuratMasukController::class, 'tolak'])
            ->name('pdisposisi.tolak');
    });

    Route::get('ldisposisi', [\App\Http\Controllers\RelDisposisiController::class, 'index'])
        ->name('ldisposisi.index');
    Route::get('ldisposisi/print', [\App\Http\Controllers\RelDisposisiController::class, 'print'])
        ->name('ldisposisi.print');

    // Route::get('suratmasuk', [\App\Http\Controllers\SuratMasukController::class, 'index'])
    //     ->name('suratmasuk.index');
    Route::get('suratkeluar', [\App\Http\Controllers\SuratKeluarController::class, 'index'])
        ->name('suratkeluar.index');
    Route::get('disposisi', [\App\Http\Controllers\DisposisiController::class, 'index'])
        ->name('disposisi.index');

    Route::get('profile', [\App\Http\Controllers\PageController::class, 'profile'])
        ->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\PageController::class, 'profileUpdate'])
        ->name('profile.update');
    Route::put('profile/deactivate', [\App\Http\Controllers\PageController::class, 'deactivate'])
        ->name('profile.deactivate')
        ->middleware(['role:staff']);

    Route::get('settings', [\App\Http\Controllers\PageController::class, 'settings'])
        ->name('settings.show')
        ->middleware(['role:admin']);
    Route::put('settings', [\App\Http\Controllers\PageController::class, 'settingsUpdate'])
        ->name('settings.update')
        ->middleware(['role:admin']);

    Route::delete('attachment', [\App\Http\Controllers\PageController::class, 'removeAttachment'])
        ->name('attachment.destroy');

    Route::prefix('transaction')->as('transaction.')->group(function () {
        Route::resource('incoming', \App\Http\Controllers\IncomingLetterController::class);
        Route::resource('outgoing', \App\Http\Controllers\OutgoingLetterController::class);
        Route::resource('{letter}/disposition', \App\Http\Controllers\DispositionController::class)->except(['show']);
    });

    Route::prefix('agenda')->as('agenda.')->group(function () {
        Route::get('incoming', [\App\Http\Controllers\IncomingLetterController::class, 'agenda'])->name('incoming');
        Route::get('incoming/print', [\App\Http\Controllers\IncomingLetterController::class, 'print'])->name('incoming.print');
        Route::get('outgoing', [\App\Http\Controllers\OutgoingLetterController::class, 'agenda'])->name('outgoing');
        Route::get('outgoing/print', [\App\Http\Controllers\OutgoingLetterController::class, 'print'])->name('outgoing.print');
    });

    Route::prefix('gallery')->as('gallery.')->group(function () {
        Route::get('incoming', [\App\Http\Controllers\LetterGalleryController::class, 'incoming'])->name('incoming');
        Route::get('outgoing', [\App\Http\Controllers\LetterGalleryController::class, 'outgoing'])->name('outgoing');
    });

    Route::prefix('reference')->as('reference.')->middleware(['role:admin'])->group(function () {
        Route::resource('classification', \App\Http\Controllers\ClassificationController::class)->except(['show', 'create', 'edit']);
        Route::resource('status', \App\Http\Controllers\LetterStatusController::class)->except(['show', 'create', 'edit']);
    });
});

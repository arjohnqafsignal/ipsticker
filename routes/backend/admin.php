<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\IPStickerController;
use Tabuna\Breadcrumbs\Trail;
use App\IpSticker;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });
Route::group([
    'prefix' => 'sticker',
    'as' => 'sticker.',],
    function(){
        Route::get('/', [StickerController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Sticker'), route('admin.sticker.index'));
        });
        Route::get('/generate', [StickerController::class, 'generate'])
        ->name('generate')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.sticker.index')->push(__('Generate'), route('admin.sticker.generate'));
        });

        Route::post('/addsticker', [StickerController::class, 'addsticker'])
        ->name('addsticker');

        Route::post('/addstickertoletter', [StickerController::class, 'addstickertoletter'])
        ->name('addstickertoletter');

        Route::post('/editsticker', [StickerController::class, 'editsticker'])
        ->name('editsticker');

        Route::get('/clearsticker/{key}', [StickerController::class, 'clearsticker'])
        ->name('clearsticker');

        Route::get('/generatesticker', [StickerController::class, 'generatesticker'])
        ->name('generatesticker');

        Route::post('/savestickers', [StickerController::class, 'savestickers'])
        ->name('savestickers');

        Route::get('/letterlist', [StickerController::class, 'letterlist'])
        ->name('letterlist');

        Route::get('/viewletter/{letter}', [StickerController::class, 'viewletter'])
        ->name('viewletter');

        Route::get('/viewstickers/{letter}', [StickerController::class, 'viewstickers'])
        ->name('viewstickers')
        ->breadcrumbs(function (Trail $trail, Letter $letter) {
            $trail->parent('admin.sticker.index')->push(__('View Stickers'), route('admin.sticker.viewstickers', $letter));
        });

        Route::get('/deleteletter/{letter}', [StickerController::class, 'deleteletter'])
        ->name('deleteletter');

        Route::get('/deletesticker/{sticker}', [StickerController::class, 'deletesticker'])
        ->name('deletesticker');

        Route::get('/printall/{letter}', [StickerController::class, 'printall'])
        ->name('printall');

        Route::get('/printsingle/{sticker}', [StickerController::class, 'printsingle'])
        ->name('printsingle');

});

Route::group([
    'prefix' => 'ipsticker',
    'as' => 'ipsticker.',],
    function(){
        Route::get('/', [IPStickerController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('IP Sticker'), route('admin.ipsticker.index'));
        });
        Route::get('/create', [IPStickerController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.ipsticker.index')
                        ->push(__('Create Sticker'), route('admin.ipsticker.create'));
        });
        Route::get('/view/{ipSticker}', [IPStickerController::class, 'view'])
        ->name('view')
        ->breadcrumbs(function (Trail $trail, IpSticker $ipSticker) {
            $trail->parent('admin.ipsticker.index')
                        ->push(__('View Sticker'), route('admin.ipsticker.view', $ipSticker));
        });
        Route::post('/', [IPStickerController::class, 'store'])->name('store');
        Route::post('/{ipSticker}`', [IPStickerController::class, 'update'])->name('update');
        Route::get('/delete/{ipSticker}', [IPStickerController::class, 'delete'])->name('delete');

        Route::get('/generate', [IPStickerController::class, 'generate'])->name('generate');

});

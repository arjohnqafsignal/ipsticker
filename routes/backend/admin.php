<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\StickerController;
use Tabuna\Breadcrumbs\Trail;
use App\Models\Letter;

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

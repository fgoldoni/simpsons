<?php

Route::as('api.')->middleware(['auth:api'])->group(function () {
    Route::resource('quotes', \Modules\Quotes\Http\Controllers\Api\QuotesController::class);
});

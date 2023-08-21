<?php

Route::as('api.')->middleware(['auth:api'])->group(function () {
    Route::resource('simpsons', \Modules\Simpsons\Http\Controllers\Api\SimpsonsController::class);
});

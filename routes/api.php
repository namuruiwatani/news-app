<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags', [TagController::class, 'store']);
Route::delete('/tags/{tag_id}', [TagController::class, 'destroy']);
Route::post('/articles/{ticket_id}/tags', [TagController::class, 'attachTagToTopic']);
Route::delete('/articles/{ticket_id}/tags/{tag_id}', [TagController::class, 'detachTagFromTopic']);

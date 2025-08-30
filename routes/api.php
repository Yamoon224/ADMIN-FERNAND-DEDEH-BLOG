<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\Api\DailyController as ApiDailyController;
use App\Http\Controllers\Api\GroupController as ApiGroupController;
use App\Http\Controllers\Api\BannerController as ApiBannerController;
use App\Http\Controllers\Api\ArticleController as ApiArticleController;
use App\Http\Controllers\Api\CommentController as ApiCommentController;
use App\Http\Controllers\Api\ContentController as ApiContentController;
use App\Http\Controllers\Api\HashtagController as ApiHashtagController;
use App\Http\Controllers\Api\QuestionController as ApiQuestionController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\ExclusivityController as ApiExclusivityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('users', ApiUserController::class);
    Route::apiResource('groups', ApiGroupController::class);
    Route::apiResource('categories', ApiCategoryController::class);
    Route::apiResource('banners', ApiBannerController::class);
    Route::apiResource('articles', ApiArticleController::class);
    Route::apiResource('comments', ApiCommentController::class);
    Route::apiResource('contents', ApiContentController::class);
    Route::apiResource('dailies', ApiDailyController::class);
    Route::apiResource('exclusivities', ApiExclusivityController::class);
    Route::apiResource('hashtags', ApiHashtagController::class);
    Route::apiResource('questions', ApiQuestionController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

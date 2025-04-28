<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController, ProjectController,
    TaskController, SubtaskController,
    CommentController, AttachmentController
};

Route::post('register', [AuthController::class,'register']);
Route::post('login',    [AuthController::class,'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('projects', ProjectController::class)
         ->middleware('scopes:manage-projects');

    Route::apiResource('projects.tasks', TaskController::class)
         ->middleware('scopes:create-tasks,edit-tasks,delete-tasks');

         
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('projects.tasks', TaskController::class)->shallow();
    Route::apiResource('tasks.subtasks', SubtaskController::class)->shallow();

    Route::post('tasks/bulk-update', [TaskController::class,'bulkUpdate']);
    Route::get('tasks/stats',        [TaskController::class,'stats']);
    Route::get('tasks',              [TaskController::class,'globalIndex']);

    Route::post('tasks/{task}/comments',    [CommentController::class,'store']);
    Route::post('tasks/{task}/attachments', [AttachmentController::class,'upload']);

    // Restore/forceDelete for soft deletes
    Route::post('tasks/{task}/restore',      [TaskController::class,'restore']);
    Route::delete('tasks/{task}/force',      [TaskController::class,'forceDelete']);
});

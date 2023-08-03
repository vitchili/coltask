<?php

use App\Http\Controllers\Auth\AuthApiController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskAttachmentController;
use App\Http\Controllers\TaskChangeController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Login routes
Route::middleware('auth:sanctum')->post('/usersFilter', [AuthApiController::class, 'usersFilter']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logout']);

//Task routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'showAll']);
    Route::get('/task/{id}', [TaskController::class, 'show']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::put('/task/{id}', [TaskController::class, 'update']);
    Route::delete('/task/{id}', [TaskController::class, 'destroy']);
});

//Task changes routes
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/task/changes/{id}', [TaskChangeController::class, 'saveTaskChanges']);
});


//Task File Attachments routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/task/{taskId}/getBase64Attachments/{directoryKey}', [TaskAttachmentController::class, 'getBase64Attachments']);
    Route::delete('/task/{taskId}/deleteTaskAttachment/{directoryKey}/{fileKey}', [TaskAttachmentController::class, 'deleteTaskAttachment']);
});


//Client routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/clients', [ClientController::class, 'showAll']);
    Route::get('/client/{id}', [ClientController::class, 'show']);
    Route::post('/client', [ClientController::class, 'store']);
    Route::put('/client/{id}', [ClientController::class, 'update']);
    Route::delete('/client/{id}', [ClientController::class, 'destroy']);
});

//Comment routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/comments', [CommentController::class, 'showAll']);
    Route::get('/comment/{id}', [CommentController::class, 'show']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::put('/comment/{id}', [CommentController::class, 'update']);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
});

//Direction routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/directions', [DirectionController::class, 'showAll']);
    Route::get('/direction/{id}', [DirectionController::class, 'show']);
    Route::post('/direction', [DirectionController::class, 'store']);
    Route::put('/direction/{id}', [DirectionController::class, 'update']);
    Route::delete('/direction/{id}', [DirectionController::class, 'destroy']);
});

//Fase routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/fases', [FaseController::class, 'showAll']);
    Route::get('/fase/{id}', [FaseController::class, 'show']);
    Route::post('/fase', [FaseController::class, 'store']);
    Route::put('/fase/{id}', [FaseController::class, 'update']);
    Route::delete('/fase/{id}', [FaseController::class, 'destroy']);
});

//Kanban routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kanbans', [KanbanController::class, 'showAll']);
    Route::get('/kanban/{id}', [KanbanController::class, 'show']);
    Route::post('/kanban', [KanbanController::class, 'store']);
    Route::put('/kanban/{id}', [KanbanController::class, 'update']);
    Route::delete('/kanban/{id}', [KanbanController::class, 'destroy']);
});

//Module routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/modules', [ModuleController::class, 'showAll']);
    Route::get('/module/{id}', [ModuleController::class, 'show']);
    Route::post('/module', [ModuleController::class, 'store']);
    Route::put('/module/{id}', [ModuleController::class, 'update']);
    Route::delete('/module/{id}', [ModuleController::class, 'destroy']);
});

//Priority routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/priorities', [PriorityController::class, 'showAll']);
    Route::get('/priority/{id}', [PriorityController::class, 'show']);
    Route::post('/priority', [PriorityController::class, 'store']);
    Route::put('/priority/{id}', [PriorityController::class, 'update']);
    Route::delete('/priority/{id}', [PriorityController::class, 'destroy']);
});

//Product routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'showAll']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
});

//Requirement routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/requirements', [RequirementController::class, 'showAll']);
    Route::get('/requirement/{id}', [RequirementController::class, 'show']);
    Route::post('/requirement', [RequirementController::class, 'store']);
    Route::put('/requirement/{id}', [RequirementController::class, 'update']);
    Route::delete('/requirement/{id}', [RequirementController::class, 'destroy']);
});

//Screen routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/screens', [ScreenController::class, 'showAll']);
    Route::get('/screen/{id}', [ScreenController::class, 'show']);
    Route::post('/screen', [ScreenController::class, 'store']);
    Route::put('/screen/{id}', [ScreenController::class, 'update']);
    Route::delete('/screen/{id}', [ScreenController::class, 'destroy']);
});

//Sprint routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/sprints', [SprintController::class, 'showAll']);
    Route::get('/sprint/{id}', [SprintController::class, 'show']);
    Route::post('/sprint', [SprintController::class, 'store']);
    Route::put('/sprint/{id}', [SprintController::class, 'update']);
    Route::delete('/sprint/{id}', [SprintController::class, 'destroy']);
});

//Project routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projects', [ProjectController::class, 'showAll']);
    Route::get('/project/{id}', [ProjectController::class, 'show']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::put('/project/{id}', [ProjectController::class, 'update']);
    Route::delete('/project/{id}', [ProjectController::class, 'destroy']);
});

//Teams routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/teams', [TeamController::class, 'showAll']);
    Route::get('/team/{id}', [TeamController::class, 'show']);
    Route::post('/team', [TeamController::class, 'store']);
    Route::put('/team/{id}', [TeamController::class, 'update']);
    Route::delete('/team/{id}', [TeamController::class, 'destroy']);
});

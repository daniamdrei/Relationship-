<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('student' , StudentController::class);
Route::apiResource('teacher' , TeacherController::class);
Route::apiResource('course' , CourseController::class);

Route::post('enroll/student/{id}', [StudentController::class , 'enroll']);
Route::get('student_under_course/{id}' , [CourseController::class , 'studentUnderCourse']);
Route::get('courses_under_teacher/{id}' , [TeacherController::class , 'coursesUnderTeacher']);

//postman link
// https://php888.postman.co/workspace/My-Workspace~de7b6356-2183-4c7b-8528-9414c5d2b308/collection/42829921-5ab7ef38-e391-402a-9837-302b557479f8?action=share&creator=42829921&active-environment=42829921-5357c09e-fec5-46b4-95ab-7c458b523680

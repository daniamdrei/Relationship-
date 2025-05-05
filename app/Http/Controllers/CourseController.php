<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(){

        $courses = Course::all();
        return response()->json($courses);
    }
    public function store( Request $request){
        $validated = Validator::make($request->all(),[
                        'teacher_id' => 'required|',
                        'name' => 'required|string|',
                    ]);

                    if($validated->fails()){
                        return response()->json($validated->errors(),400);
                    }
        $course = Course::create([
            'teacher_id'=>$request->teacher_id,
            'name'=>$request->name]);

        return response()->json([
            'message'=>'course creates successfully',
            'course'=>$course,
        ]);
    }
    public function update(Request $request , Course $course){

        $validated = Validator::make($request->all(),[
            'teacher_id' => 'required|',
            'name' => 'required|string|',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }

        $course->update([
            'teacher_id'=>$request->teacher_id,
            'name'=>$request->name]);

        return response()->json([
            'message'=>'course creates successfully',
            'course'=>$course,
        ]);
    }
    public function destroy( Course $course){
        $course->delete();
        return response()->json(['message'=>'course deleted successfully']);
    }

    public function studentUnderCourse(string $courseId){

        $student = Enrollment::where('course_id' , $courseId)->get();

        // $student = Student::whereHas('courses')
        // ->where('id' , $courseId)->get();
        // return $student;
    }


}

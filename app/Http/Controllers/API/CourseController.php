<?php

namespace App\Http\Controllers\API;

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
        return $this->api_response(true , 'fetch data successfully' , $courses , 200);
    }
    public function store( Request $request){
        $validated = Validator::make($request->all(),[
                        'teacher_id' => 'required|',
                        'name' => 'required|string|',
                    ]);

                    if($validated->fails()){
                        return $this->api_response(false, 'course Not Found', [], 404);
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
            return $this->api_response(false, 'course Not Found', [], 404);
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
        return response()->json(['message'=>'course creates successfully']);

    }

    public function studentUnderCourse(string $courseId){

        //
        $course = Course::findOrFail($courseId);

        if(!isset($course)){
            return $this->api_response(false, 'course Not Found', [], 404);
        }

        $students = Enrollment::where('course_id' , $courseId)->get();
        
        return $this->api_response(true , 'all student' , $students , 200);
    }


}

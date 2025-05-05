<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Logging\TeamCity\TeamCityLogger;

class TeacherController extends Controller
{
    public function index(){

        $teachers = Teacher::all();
        return response()->json($teachers);
    }
    public function store( Request $request){

        $validated = Validator::make($request->all(),[
            'name' => 'required|string|',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }


        $teacher = Teacher::create(['name'=>$request->name]);

        return response()->json([
            'message'=>'teacher creates successfully',
            'teacher'=>$teacher,
        ]);
    }
    public function update(Request $request , Teacher $teacher){

        $validated = Validator::make($request->all(),[
            'name' => 'required|string|',
        ]);

        if($validated->fails()){

            return response()->json($validated->errors(),400);
        }
        $teacher->update(['name'=>$request->name]);

        return response()->json([
            'message'=>'teacher creates successfully',
            'teacher'=>$teacher,
        ]);
    }
    public function destroy( Teacher $teacher){
        $teacher->delete();
        return response()->json(['message'=>'teacher deleted successfully']);
    }

    public function coursesUnderTeacher(string $teacherId){

        $courses = Course::where('teacher_id', $teacherId)->get();

        return $courses;
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){

        $student = Student::all();
        return response()->json($student);
    }
    public function store( Request $request){

        $validated = Validator::make($request->all(),[
            'name' => 'required|string|',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }

        $student = Student::create(['name'=>$request->name]);

        return response()->json([
            'message'=>'student creates successfully',
            'student'=>$student,
        ]);
    }
    public function update(Request $request , Student $student){

        $validated = Validator::make($request->all(),[
            'name' => 'required|string|',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }

        if($validated->fails()){
            return response()->json($validated->errors() , 401);
        }

        $student->update(['name'=>$request->name]);

        return response()->json([
            'message'=>'student creates successfully',
            'student'=>$student,
        ]);
    }
    public function destroy( Student $student){
        $student->delete();
        return response()->json(['message'=>'student deleted successfully']);
    }


    public function enroll(Request $request , string $studentId){
        //validation
        $validated = Validator::make($request->all(),[
            'course_id'=> 'required',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }
        $student = Student::findOrFail($studentId);
        $student->courses()->attach(['course_id'=>$request->course_id]);

        return response()->json(['message' => 'student enrolling successfully']);
    }
}

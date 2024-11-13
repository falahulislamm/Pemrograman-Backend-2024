<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
// SHOW
    public function show($id) {
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'mesasage' => 'Student not found',
            ];

            return response()->json($data, 404);
        }
    }



// INDEX
    public function index() {
        $students = Student::all();

        if ($students) {
        $data = [
            'message' => 'Get all students',
            'data' => $students,
        ];

    } else {
        $data = [
            'message' => 'Student is empty',
        ];
    }

        return response()->json($data, 200);
    }

// STORE 
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'nim' => 'numeric|required',
        'email' => 'email|required',
        'jurusan' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);
    }

    $student = Student::create($request->all());

    $data = [
        'message' => 'Student is created successfully',
        'data' => $student
    ];
    return response()->json($data, 201);
}

// UPDATE 
    public function update(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nama' => 'sometimes|string|max:255',
        'nim' => 'sometimes|unique:students,nim,' . $id,
        'email' => 'sometimes|email|unique:students,email,' . $id,
        'jurusan' => 'sometimes|string|max:100',
    ]);

    $student = Student::find($id);

    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    $student->update($validatedData);

    $data = [
        'message' => 'Student updated successfully',
        'data' => $student,
    ];

    return response()->json($data, 200);
    }

// DESTROY
    public function destroy($id)
    {
    $student = Student::find($id);

    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    $student->delete();

    return response()->json(['message' => 'Student deleted successfully'], 200);
    }

}
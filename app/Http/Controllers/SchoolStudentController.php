<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class SchoolStudentController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(School $school, Student $student)
    {
        return compact('school', 'student');
    }

    public function update(Request $request, School $school, Student $student)
    {
    }

    public function destroy(School $school, Student $student)
    {
    }
}

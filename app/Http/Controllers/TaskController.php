<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
class TaskController extends Controller
{
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'title_hr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description' => 'required|string',
            'study_type' => 'required|in:stručni,preddiplomski,diplomski',
        ]);

    
        Task::create([
            'teacher_id' => auth()->id(),  
            'title_hr' => $request->title_hr,
            'title_en' => $request->title_en,
            'description' => $request->description,
            'study_type' => $request->study_type,
        ]);

    
        return redirect()->back()->with('success', 'Rad je uspješno dodan!');
    }


public function index()
    {
        $teacher=auth()->user();
        $tasks = Task::where('teacher_id', $teacher->id)->with('students')->get();
        return view('tasks.view', compact('tasks'));
    }


    public function update(Request $request)
{
    $taskid = $request->task_id;
    $studentId = $request->student;

    $student = User::find($studentId);

    if ($student) {
        $student->tasks()->updateExistingPivot($taskid, ['status' => 'accepted']);
        return back()->with('success', 'Student prihvaćen.');
    }

    return back()->with('error', 'Student nije pronađen.');
}
}
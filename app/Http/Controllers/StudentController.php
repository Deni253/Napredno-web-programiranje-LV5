<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class StudentController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $tasks = Task::with('students')
            ->get()
            ->filter(function ($task) use ($userId) {
 
                $accepted = $task->students
                    ->firstWhere('pivot.status', 'accepted');
                
                if (!$accepted) {
                    return true;
                }
                
                return $accepted->id == $userId;
            });

        return view('student.see', compact('tasks'));
    }

    public function prijava(Task $task)
    {       
        $student=auth()->user();

        if ($student->tasks()->where('task_id', $task->id)->exists()) {
            return back()->with('error', 'Već ste prijavljeni na ovaj rad.');
        }

       $student->tasks()->attach($task->id, [
        'student_name' => $student->name,
        'task_title' => $task->title_hr
        ]);

        return redirect()->back()->with('success', 'Uloga ažurirana.');
    }
}

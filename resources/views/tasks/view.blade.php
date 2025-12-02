@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Radovi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="border px-4 py-2">Naziv</th>
                <th class="border px-4 py-2">Naziv EN</th>
                <th class="border px-4 py-2">Opis</th>
                <th class="border px-4 py-2">Tip Studija</th>
                <th class="border px-4 py-2">Prijavljeni studenti</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td class="border px-4 py-2">{{ $task->title_hr }}</td>
                <td class="border px-4 py-2">{{ $task->title_en }}</td>
                <td class="border px-4 py-2">{{ $task->description }}</td>
                <td class="border px-4 py-2">{{ $task->study_type }}</td>
               <td class="border px-4 py-2">
                    @php
                        $acceptedStudents = $task->students->filter(fn($s) => $s->pivot->status === 'accepted');
                    @endphp

                    @if($acceptedStudents->isEmpty())
                        <form action="{{ route('tasks.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">

                            <select name="student">
                                <option value="">Odaberi</option>
                                @foreach($task->students as $student)
                                    <option value="{{ $student->pivot->user_id }}">{{ $student->pivot->student_name }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Prihvati
                            </button>
                        </form>
                    @else
                        student prihvaćen
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<table class="table table-bordered px-4 py-2">
    <thead>
        <tr>
            <th class="border px-4 py-2">Naziv</th>
            <th class="border px-4 py-2">Naziv EN</th>
            <th class="border px-4 py-2">Opis</th>
            <th class="border px-4 py-2">Tip Studija</th>
            <th class="border px-4 py-2">Prihvaćeni studenti</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td class="border px-4 py-2">{{ $task->title_hr }}</td>
            <td class="border px-4 py-2">{{ $task->title_en }}</td>
            <td class="border px-4 py-2">{{ $task->description }}</td>
            <td class="border px-4 py-2">{{ $task->study_type }}</td>
            <td class="border px-4 py-2">
                @php
                    $acceptedStudents = $task->students->filter(fn($s) => $s->pivot->status === 'accepted');
                @endphp

                @if($acceptedStudents->isEmpty())
                    Nema prihvaćenih studenata
                @else
                    @foreach($acceptedStudents as $student)
                        {{ $student->pivot->student_name }}<br>
                    @endforeach
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endsection
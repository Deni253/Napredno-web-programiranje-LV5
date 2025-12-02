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
                <th class="border px-4 py-2">Status prijave</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            @php
                $studentPivot = $task->students->firstWhere('id', auth()->id());
            @endphp
            <tr>
                <td class="border px-4 py-2">{{ $task->title_hr }}</td>
                <td class="border px-4 py-2">{{ $task->title_en }}</td>
                <td class="border px-4 py-2">{{ $task->description }}</td>
                <td class="border px-4 py-2">{{ $task->study_type }}</td>
                <td class="border px-4 py-2">
                    @if($studentPivot)
                        @if($studentPivot->pivot->status === 'accepted')
                            <span class="text-green-600 font-bold">Prihvaćena od profesora</span>
                        @else
                            <span class="text-yellow-600 font-bold">Prijavljena, čeka odobrenje</span>
                        @endif
                    @else
                        <form action="{{ route('student.prijavi', $task->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Prijavi
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
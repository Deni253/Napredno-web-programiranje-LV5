@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj rad</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title_hr" placeholder="Naziv HR" value="{{ old('title_hr') }}">
        <input type="text" name="title_en" placeholder="Naziv EN" value="{{ old('title_en') }}">
        <textarea name="description" placeholder="Opis zadatka">{{ old('description') }}</textarea>
        <select name="study_type">
            <option value="stručni">Stručni</option>
            <option value="preddiplomski">Preddiplomski</option>
            <option value="diplomski">Diplomski</option>
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dodaj rad</button>
    </form>
</div>
@endsection
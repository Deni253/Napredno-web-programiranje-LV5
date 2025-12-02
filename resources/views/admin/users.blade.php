@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upravljanje korisnicima</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Ime</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Uloga</th>
                <th class="border px-4 py-2">Akcija</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ $user->role }}</td>
                <td class="border px-4 py-2">
                    <form action="{{ route('admin.updateRole', $user->id) }}" method="POST">
                        @csrf
                        <select name="role" class="form-select d-inline-block w-auto">
                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                            <option value="nastavnik" {{ $user->role === 'nastavnik' ? 'selected' : '' }}>Nastavnik</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Promijeni</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
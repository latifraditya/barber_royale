@extends('admin.dashboard.layouts.main')


@section('container')


    <h1>Dashboard Admin</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Jumlah Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->bookings->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
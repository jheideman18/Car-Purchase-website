@extends('layouts.admin');

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Registered users</h4>
        <hr>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Phone</th>
                <th>Address 1</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td >{{$user->name}}</td>
                    <td>{{$user->lname}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address1}}</td>
                    <td>
                        <a href="{{url('view-user/'.$user->id)}}" class="btn btn-primary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection

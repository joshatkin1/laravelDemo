@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>job</th>
                            <th>active</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover table-primary">
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['job']}}</td>
                            <td>{{$user['active']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

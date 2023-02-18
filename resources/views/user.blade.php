@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header flex align-items-center flex-column justify-content-center">
                        <h1 class="header">{{$user['name']}}</h1>
                    </div>

                    <div class="card-columns card-body">

                        {{--                    <table class="table table-bordered table-hover">--}}
                        {{--                        <thead>--}}
                        {{--                        <tr>--}}
                        {{--                            <th>name</th>--}}
                        {{--                            <th>email</th>--}}
                        {{--                            <th>job</th>--}}
                        {{--                            <th>active</th>--}}
                        {{--                        </tr>--}}
                        {{--                        </thead>--}}
                        {{--                        <tbody class="table-hover table-primary">--}}
                        {{--                        @foreach($users['skills'] as $skill)--}}
                        {{--                            <tr>--}}
                        {{--                                <td>{{$skill['id']}}</td>--}}
                        {{--                                <td>{{$skill['skill']}}</td>--}}
                        {{--                                <td>{{$skill['level']}}</td>--}}
                        {{--                            </tr>--}}
                        {{--                        @endforeach--}}
                        {{--                        </tbody>--}}
                        {{--                    </table>--}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

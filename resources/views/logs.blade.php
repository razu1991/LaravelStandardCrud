@extends('layouts.app')
@section('panel')
    <div class="main-content mt-50">
        <div class="container">
            <div class="row">

                <h4 class="mb-5">
                    <a href="{{route('home')}}" class="btn btn-success">
                        Go Back
                    </a>
                    Logs of [<b>{{$logs->first()->user->name}}</b>]
                </h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $key=>$log)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$log->title}} </td>
                                <td>{{$log->details}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

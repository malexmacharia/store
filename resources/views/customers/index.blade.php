@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Customers &nbsp;&nbsp;&nbsp;
                        <a href="{{route('customers.create')}}" class="btn btn-primary" role="button">
                            <span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Add New Customer
                        </a>

                    </div>

                    <div class="card-body">
                    
                        <table class="table">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$s->name}}</td>
                                <td>{{$s->phone}}</td>
                                <td>{{$s->address}}</td>
                                <td>{{$s->email}}</td>

                            </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.datatable')
@endsection

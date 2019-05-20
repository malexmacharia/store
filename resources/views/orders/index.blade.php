@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Orders &nbsp;&nbsp;&nbsp;<a href="{{route('orders.create')}}"> Add a New Order</a></div>

                    <div class="card-body">

                        <table class="table" id="orders">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Phone No</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Details</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$s->customer->name}}</td>
                                    <td>{{$s->customer->phone}}</td>
                                    <td>{{$s->shipped? 'Shipped':'Pending'}}</td>
                                    <td>{{$s->total}}</td>
                                    <td><a href="/orders/{{$s->id}}" class="btn btn-success">Details</a> </td>
                                    <td>
                                        @if(!$s->shipped)
                                            @can('delete',$s)
                                            <form action="/orders/{{$s->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                    Delete
                                                </button>

                                            </form>
                                            @endcan
                                        @endif
                                    </td>

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

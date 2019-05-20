@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Products &nbsp;&nbsp;
                        &nbsp;<a href="{{route('products.create')}}" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span>
                            Add a New Product</a></div>

                    <div class="card-body">

                        <table class="table" id="products">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$s->name}}</td>
                                    <td>{{$s->quantity}}</td>
                                    <td>{{$s->price}}</td>
                                    <td><a href="">Edit</a></td>

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

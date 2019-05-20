@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add an Order</div>

                    <div class="card-body">

                        <form action="/orders" method="post">
                            @csrf

                            <div class="form-group">
                                <label> Select Customer </label>
                                <option value=""></option>

                                <select name="customer_id"  class="form-control">
                                    <option value=""></option>
                                @foreach($customers as $customer)

                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('customer_id'))
                                    <span class='text-danger'>{{$errors->first('customer_id')}}</span>
                                @endif

                            </div>
                            <button class="btn btn-info ">Add Order</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

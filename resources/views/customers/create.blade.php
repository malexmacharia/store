@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Customer</div>

                    <div class="card-body">

                        <form action="/customers" method="post">
                            @csrf
                            <div class="form-group">
                                <label> Customer's Names</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                 @if($errors->has('name'))
                                     <span class='text-danger'>{{$errors->first('name')}}</span>
                                 @endif
                            </div>

                            <div class="form-group">
                                <label> Customer's Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                @if($errors->has('phone'))
                                    <span class='text-danger'>{{$errors->first('phone')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Customer's Address</label>
                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                @if($errors->has('address'))
                                    <span class='text-danger'>{{$errors->first('address')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Customer's Email</label>
                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <span class='text-danger'>{{$errors->first('email')}}</span>
                                @endif
                            </div>

                            <button class="btn btn-info ">Add Customer</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

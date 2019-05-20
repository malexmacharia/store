@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add a Product</div>

                    <div class="card-body">

                        <form action="/products" method="post">
                            @csrf
                            <div class="form-group">
                                <label> Product's Names</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                @if($errors->has('name'))
                                    <span class='text-danger'>{{$errors->first('name')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Product Quantity</label>
                                <input type="text" class="form-control" name="quantity" value={{old('quantity')}}>
                                @if($errors->has('quantity'))
                                    <span class='text-danger'>{{$errors->first('quantity')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Product Price</label>
                                <input type="text" class="form-control" name="price" value={{old('price')}}>
                                @if($errors->has('price'))
                                    <span class='text-danger'>{{$errors->first('price')}}</span>
                                @endif
                            </div>
                            <button class="btn btn-info ">Add Products</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.include.master')

@section('content')
<div class="container_fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Size List</h5>
                    </div>
                    @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Si</th>
                                    <th>Product name</th>
                                    <th>Color name</th>
                                    <th>Size name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $key=>$inventory)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $inventory->product->name ?? 'N/A' }}</td>
                                    <td>{{ $inventory->color->name ?? 'N/A' }}</td>
                                    <td>{{ $inventory->size->name ?? 'N/A' }}</td>
                                    <td>{{$inventory->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Inventory</h3>
                </div>
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <input type="text" class="form-control mt-3" readonly value="{{$product->name}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                    </div>
                    <div class="form-group mb-2">
                        <select name="color_id" class="form-control">
                            <option value="">--select color--</option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <select name="size_id" class="form-control">
                            <option value="">--select size--</option>
                            @foreach($sizes as $size)
                                <option value="{{$size->id}}">{{$size->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="save" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
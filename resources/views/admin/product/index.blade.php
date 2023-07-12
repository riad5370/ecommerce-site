@extends('admin.include.master')
@push('css')
    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/datatables.css">
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Products List</h5>
                    <form class="d-inline-flex">
                        <a href="{{route('products.create')}}" class="align-items-center btn btn-theme">
                            <i data-feather="plus"></i>Add New
                        </a>
                    </form>
                </div>
                @if(session('success'))
                        <div class="alert alert-primary">{{session('success')}}</div>
                        @endif
                <div class="table-responsive table-product">
                    <table class="table all-package theme-table" id="table_id">
                        <thead>
                            <tr>
                                <th>si</th>
                                <th>category</th>
                                <th>subcategory</th>
                                <th>product</th>
                                <th>brand</th>
                                <th>price</th>
                                <th>discount</th>
                                <th>preview</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key=>$product)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{ $product->category->name ?: 'Unknown Category' }}</td>
                                    <td>{{ $product->subcategory->name ?: 'Unknown Category' }}</td>
                                    <td>{{ $product->name}}</td>
                                    <td>{{ $product->brand}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->discount}}%</td>
                                    <td>
                                      <img width="50" src="{{asset('uploads/product/preview/'.$product->preview)}}" alt=""> 
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{route('products.inventory',$product->id)}}" class="btn btn-sm btn-primary">
                                                   inventory
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('products.edit',$product->id)}}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                            

                                            <li>
                                                <form action="{{route('products.destroy',$product->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <i class="ri-delete-bin-line"></i>
                                                      </button>
                                                </form>
                                            </li>
                                        </ul>
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
</div>
@endsection
@if (count($products) > 10)
@push('js')
    <!-- Data table js -->
    <script src="{{asset('backend')}}/assets/js/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/assets/js/custom-data-table.js"></script>
    <!-- all checkbox select js -->
    <script src="{{asset('backend')}}/assets/js/checkbox-all-check.js"></script>
@endpush
@endif
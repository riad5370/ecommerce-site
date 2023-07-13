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
                    <h5>SubCategory List</h5>
                    <form class="d-inline-flex">
                        <a href="{{route('subcategories.create')}}" class="align-items-center btn btn-theme">
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
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>image</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $key=>$category)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{ $category->category->name ?: 'Unknown Category' }}</td>
                                    <td>{{ $category->name}}</td>
                                    <td>
                                        @if ($category->image)
                                        <img width="70" src="{{asset('uploads/subcategory/'.$category->image)}}" alt="">
                                        @else
                                        <span>No Image</span>   
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{route('subcategories.edit',$category->id)}}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{route('subcategories.destroy',$category->id)}}" method="POST">
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
@if (count($subcategories) > 10)
@push('js')
    <!-- Data table js -->
    <script src="{{asset('backend')}}/assets/js/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/assets/js/custom-data-table.js"></script>
    <!-- all checkbox select js -->
    <script src="{{asset('backend')}}/assets/js/checkbox-all-check.js"></script>
@endpush
@endif
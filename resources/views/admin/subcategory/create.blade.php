@extends('admin.include.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Add New Subcategory</h5>
                        </div>
                        <form action="{{route('subcategories.store')}}" method="POST" class="theme-form theme-form-2 mega-form" enctype="multipart/form-data">
                            @csrf
                            @if(session('success'))
                            <div class="alert alert-primary">{{session('success')}}</div>
                        @endif
                        <div class="mb-4 row align-items-center">
                            <div class="col-sm-12">
                                <label class="form-label-title  mb-2">Category Name<span class="text-danger">*</span></label>
                                <select name="category_id" id="" class="form-control form-select" >
                                    <option value="">select category:</option> 
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                </select>
                                @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div> 
                        </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title mb-0">Subcategory Name<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="name" name="name" type="text" placeholder="subcategory Name">
                                </div>
                                @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
    
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title mb-2">Image<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                                    <img src="" id="blah" alt="">
                                </div>
                                @error('stock')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary d-inline btn-sm" type="submit">Save</button>
                                <a class="btn btn-secondary d-inline" href="">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.include.master')
@section('content')
<div class="container_fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product Information</h3>
            </div>
            <div class="card-body">
                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-primary">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-secondary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select name="category_id" id="categori_id" class="form-control">
                                    <option value="">--select category--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select name="subcategory_id" id="subcategory" class="form-control">
                                    <option value="">--select category--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Product Name">
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="form-group">
                                <input type="number" class="form-control" name="price" placeholder="product Price">
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="form-group">
                                <input type="number" class="form-control" name="discount" placeholder="Discount %">
                            </div>
                        </div>
                        <div class="col-lg-5 mt-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="brand" placeholder="Product Brand">
                            </div>
                        </div>
                        <div class="col-lg-7 mt-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="short_desp" placeholder="Short Description">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <textarea class="form-control" id="summernote" name="long_desp" placeholder="Long Description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="form-group">
                                <label for="" class="form-label">Product Preview</label>
                                <input type="file" name="preview" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="form-group">
                                <label for="" class="form-label">Product Thumbnails</label>
                                <input type="file" class="form-control" multiple name="thumbnail[]">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="form-group text-center">
                                <button type="submit" name="btn" value="product_information" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
@endsection
 @push('js')
 {{-- //Getting subcategory information --}}
    <script>
        $('#categori_id').change(function(){
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/getsubcategory',
                type:'POST',
                data:{'category': category_id},
                success:function(data){
                    $('#subcategory').html(data.options);
                }
            });
        });
    </script>
    {{-- summernote --}}
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
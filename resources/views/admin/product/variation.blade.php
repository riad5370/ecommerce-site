@extends('admin.include.master')
@section('content')
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Product variations</h5>
                    </div>
                    <form action="{{route('variation.store')}}" class="theme-form theme-form-2 mega-form" method="POST">
                        @csrf
                        @if (session('success'))
                        <div class="alert alert-primary">{{session('success')}}</div>
                        @endif
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Option Name</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single w-100" name="option_name" id="option_name">
                                    <option>-- select option --</option>
                                    <option value="color">Color</option>
                                    <option value="size">Size</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-3 col-form-label form-label-title">Option Value</label>
                            <div class="col-sm-9">
                                <div class="bs-example">
                                    <input type="text" class="form-control" placeholder="Type tag & hit enter" id="option_value"
                                        data-role="tagsinput" name="option_value">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center" id="color_fields" style="display: none;">
                            <label class="col-sm-3 col-form-label form-label-title">Color Code</label>
                            <div class="col-sm-9">
                                <div class="bs-example">
                                    <input type="text" class="form-control" placeholder="Enter color code" id="color_code"
                                        name="color_code">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
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
                                    <th>si</th>
                                    <th>name</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($sizes as $index => $size)
                                   <tr>
                                      <td>{{$index+1}}</td>
                                      <td>{{$size->name}}</td>
                                      <td></td>
                                   </tr>
                               @endforeach  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Color List</h5>
                    </div>
                    @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>si</th>
                                    <th>name</th>
                                    <th>color_code</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($colors as $index => $color)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$color->name}}</td>
                                <td>
                                    <span class="badge rounded-pill" style="background-color: {{ $color->color_code }}">{{$color->name}}</span>
                                </td>
                                <td></td>
                            </tr>
                            @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const optionNameSelect = document.getElementById('option_name');
        const colorFields = document.getElementById('color_fields');
        const colorCodeInput = document.getElementById('color_code');

        optionNameSelect.addEventListener('change', function() {
            const selectedOption = this.value;
            if (selectedOption === 'color') {
                colorFields.style.display = 'block';
            } else {
                colorFields.style.display = 'none';
                colorCodeInput.value = '';
            }
        });
    });
</script>
@endpush
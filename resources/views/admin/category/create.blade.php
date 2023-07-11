@extends('admin.include.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Add New Category</h5>
                        </div>
                        @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <form action="{{route('categories.store')}}" method="POST" class="theme-form theme-form-2 mega-form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                @php
                                    $icons = [
                                        'fa-500px',
                                        'fa-address-book',
                                        'fa-address-book-o',
                                        'fa-address-card',
                                        'fa-address-card-o',
                                        'fa-adjust',
                                        'fa-adn',
                                        'fa-align-center',
                                        'fa-align-justify',
                                        'fa-align-left',
                                        'fa-align-right',
                                        'fa-amazon',
                                        'fa-ambulance',
                                        'fa-american-sign-language-interpreting',
                                        'fa-caret-down',
                                        'fa-caret-left',
                                        'fa-caret-right',
                                        'fa-caret-square-o-down',
                                        'fa-caret-square-o-left',
                                        'fa-caret-square-o-right',
                                        'fa-caret-square-o-up',
                                        'fa-caret-up',
                                        'fa-cart-arrow-down',
                                        'fa-cart-plus',
                                        'fa-cc',
                                        'fa-cc-amex',
                                        'fa-cc-diners-club',
                                        'fa-cc-discover',
                                        'fa-cc-jcb',
                                        'fa-cc-mastercard',
                                        'fa-cc-paypal',
                                        'fa-cc-stripe',
                                        'fa-cc-visa',
                                        'fa-certificate', 
                                        'fa-child',
                                        'fa-clock-o',   
                                    ];
                                @endphp
                                <label for="form-label">select icon</label>
                                <div style="font-family: fontawesome; font-size:20px">
                                    @foreach($icons as $icon)
                                        <i class="fa {{$icon}}" data-icon="{{$icon}}"></i>
                                    @endforeach
                                    <input type="text" id="icon" class="form-control" name="icon" placeholder="icon">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                 <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                                @error('image')
                                 <strong class="text-danger">{{$message}}</strong>
                                @enderror
                                <img width="100" src="" id="blah" alt="">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success mt-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('.fa').click(function(){
    var icon = $(this).attr('data-icon');
    $('#icon').attr('value',icon);
    });
</script>

@endpush
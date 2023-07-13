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
                                        'fa-tshirt',
                                        'fa-tv', 
                                        'fa-gift', 
                                        'fa-leaf', 
                                        'fa-headphones-alt', 
                                        'fa-football-ball',
                                        'fa-hat-wizard',
                                        'fa-couch',
                                        'fa-running',
                                        'fa-house-damage'
                                    ];
                                @endphp
                                <label for="form-label">select icon</label>
                                <div style="font-family: fontawesome; font-size:20px">
                                    @foreach($icons as $icon)
                                        <i class="fas {{$icon}}" data-icon="{{$icon}}"></i>
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
    $('.fas').click(function(){
    var icon = $(this).attr('data-icon');
    $('#icon').attr('value',icon);
    });
</script>

@endpush
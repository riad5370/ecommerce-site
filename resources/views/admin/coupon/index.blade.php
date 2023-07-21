@extends('admin.include.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Coupon List</h5>
                    <form class="d-inline-flex">
                        <a href="{{route('coupons.create')}}" class="align-items-center btn btn-theme">
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
                                <th>Si</th>
                                <th>Coupon</th>
                                <th>Discount</th>
                                <th>Expire Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $key=>$coupon)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->discount }} {{ ($coupon->type == 1)?'%':'TK' }}</td>
                                    <td>{{ $coupon->expire }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{route('coupons.edit',$coupon->id)}}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{route('coupons.destroy',$coupon->id)}}" method="POST">
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
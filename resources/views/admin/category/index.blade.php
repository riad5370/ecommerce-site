@extends('admin.include.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Category List</h5>
                    <form class="d-inline-flex">
                        <a href="{{route('categories.create')}}" class="align-items-center btn btn-theme">
                            <i data-feather="plus"></i>Add New
                        </a>
                    </form>
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
                                <th>added_by</th>
                                <th>image</th>
                                <th>icon</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=>$category)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if(App\Models\User::where('id',$category->user_id)->exists())
                                            {{$category->user->name}}
                                        @else
                                            unkhown
                                        @endif
                                        </td>
                                        <td>
                                            <img width="75" src="{{asset('uploads/category/'.$category->image)}}" alt="">
                                        </td>
                                        <td style="font-family: fontawesome"><i class="{{$category->icon}}"></i></td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{route('categories.edit',$category->id)}}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{route('categories.destroy',$category->id)}}" method="POST">
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
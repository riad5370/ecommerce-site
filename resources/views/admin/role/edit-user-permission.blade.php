@extends('admin.include.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit User Permission</div>
                <div class="card-body">
                    <form action="{{route('permission.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <h5>{{$users->name}} <span class="float-right badge badge-success">
                                @foreach ($users->getRoleNames() as $role )
                                    {{$role}}
                                @endforeach
                            </span></h5>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="id" value="{{$users->id}}">
                        </div>
                        <div class="mb-3">
                            <h4 class="mb-2">Permission</h4>
                            @foreach ($permissions as $key=>$permission)
                                <div class="form-check form-check-inline" style="margin-bottom: 0px!important; margin-top: 0px;">
                                    <label class="form-check-label">
                                        <input {{($users->hasPermissionTo($permission->name))?'checked':''}} type="checkbox" name="permission[]" value="{{$permission->id}}" class="form-check-input">{{$permission->name}}
                                    <i class="input-frame"></i></label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-5">
                            <input type="submit" value="update" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
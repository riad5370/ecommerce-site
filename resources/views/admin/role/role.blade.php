@extends('admin.include.master')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Role List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>si</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key=>$role)
                                <tr>
                                    <th>{{$key+1}}</th>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @foreach ($role->getAllPermissions() as $permission)
                                            <span class="badge badge-primary">{{$permission->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-danger mb-2">Edit</a>
                                        <a href="{{ route('delete.permission',$role->id) }}" class="btn btn-sm btn-danger">Remove</a>   
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h6 class="card-title">User List</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>si</th>
                                <th>user</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key=>$user)
                                <tr>
                                    <th>{{$key+1}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @forelse ($user->getRoleNames() as $role)
                                          <span class="badge badge-success">{{$role}}</span>
                                        @empty
                                            <span class="badge badge-secondary">Not Assigned</span>
                                        @endforelse
                                    <td>
                                        @forelse ($user->getAllPermissions() as $permission)
                                            <span class="badge badge-success">{{$permission->name}}</span>
                                        @empty
                                           <span class="badge badge-secondary">Not Assigned</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <a href="{{route('remove.role',$user->id)}}" class="btn btn-sm btn-danger mb-2">Remove</a>
                                        <a href="{{route('edit.user.permission',$user->id)}}" class="btn btn-sm btn-danger">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Permission</h3>
            </div>
            <div class="card-body">
                <form action="{{route('permission.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="permission_name" class="form-control">
                    </div>
                    <input type="submit" name="name" class="btn btn-primary btn-sm">
                </form>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-header">Add Role</div>
            <div class="card-body">
                <form action="{{route('role.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="role_name" class="form-control" placeholder="Role-name">
                    </div>
                    <div class="form-group">
                    <h4 class="mb-2">Permission</h4>
                        @foreach ($permissions as $key=>$permission)
                            <div class="form-check form-check-inline" style="margin-bottom: 0px!important; margin-top: 0px;">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permission[]" value="{{$permission->id}}" class="form-check-input">{{$permission->name}}
                                <i class="input-frame"></i></label>
                            </div>
                        @endforeach
                    </div>
                    <input type="submit" name="name" class="btn btn-primary btn-sm">
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">Assign Role</div>
            <div class="card-body">
                <form action="{{route('assign.role')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <select name="user_id" class="form-control" id="">
                            <option>--select user--</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <select name="role_id" class="form-control" id="">
                            <option>--select Role--</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="name" class="btn btn-primary btn-sm">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
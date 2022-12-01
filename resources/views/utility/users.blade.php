<div class="row">
    <div class="col-4 gx-0 py-2">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
            <i class="fa fa-plus"></i> Add New User
        </a>
    </div>
    <div class="col-8 gx-0 py-2 text-end">
        <a href="{{route('user.print',['type'=>'csv','name' => request()->name,'email' => request()->email,'phone' => request()->phone,'age' => request()->age, 'country' => request()->country])}}"
           class="btn btn-secondary">CSV</a>
        <a href="{{route('user.print',['type' => 'pdf','name' => request()->name,'email' => request()->email,'phone' => request()->phone,'age' => request()->age, 'country' => request()->country])}}"
           class="btn btn-secondary">PDF</a>
        <a href="{{route('user.print',['type'=>'excel','name' => request()->name,'email' => request()->email,'phone' => request()->phone,'age' => request()->age, 'country' => request()->country])}}"
           class="btn btn-secondary">EXCEL</a>
    </div>
</div>
<table class="table table-bordered table-hover">
    <thead class="bg-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Age</th>
        <th scope="col">Country</th>
        <th scope="col">Activity Log</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>#</td>
        <td><input type="text" name="name" class="form-control search" placeholder="Filter Name.."
                   value="{{request()->name}}">
        </td>
        <td><input type="text" name="email" class="form-control search" placeholder="Filter Email.."
                   value="{{request()->email}}"></td>
        <td><input type="text" name="phone" class="form-control search" placeholder="Filter Phone.."
                   value="{{request()->phone}}"></td>
        <td><input type="text" name="age" class="form-control search" placeholder="Filter Age.."
                   value="{{request()->age}}"></td>
        <td><input type="text" name="country" class="form-control search" placeholder="Filter Country.."
                   value="{{request()->country}}"></td>
        <td>#</td>
        <td>#</td>
    </tr>
    @forelse($users as $key=>$user)
        <tr class="user-list">
            <th scope="row">{{$key+1}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->country ?? 'No Info'}}</td>
            <td>
                <a href="{{route('user.logs',$user->id)}}" class="btn btn-warning btn-sm"><i
                        class="fa fa-eye"></i> Activity</a>
            </td>
            <td>
                <a href="#" class="btn btn-primary btn-sm mb-1 editBtn"
                   data-action="{{route('user.update',$user->id)}}" data-name="{{$user->name}}"
                   data-email="{{$user->email}}" data-phone="{{$user->phone}}"
                   data-age="{{ $user->age }}" data-country="{{$user->country}}"><i
                        class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm deleteBtn"
                   data-action="{{ route('user.destroy',$user->id) }}"><i
                        class="fa fa-remove"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="no-rec-found text-center">No Record Found</td>
        </tr>
    @endforelse
    <tr class="loading-icon d-none">
        <td colspan="8" class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></td>
    </tr>
    </tbody>
</table>
{{ $users }}

@extends('layouts.app')
@section('panel')
    <div class="main-content mt-50">
        <div class="container">
            <div id="ajaxUserList">
                <div class="row">
                    <div class="col-4 gx-0 py-2">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
                            <i class="fa fa-plus"></i> Add New User
                        </a>
                    </div>
                    <div class="col-8 py-2 text-end">
                        <a href="{{route('user.print',['type'=>'csv','name' => request()->name,'email' => request()->email,'phone' => request()->phone,'age' => request()->age, 'country' => request()->country])}}"
                           class="btn btn-secondary">CSV</a>
                        <a href="{{route('user.print',['type' => 'pdf','name' => request()->name,'email' => request()->email,'phone' => request()->phone,'age' => request()->age, 'country' => request()->country])}}"
                           class="btn btn-secondary">PDF</a>
                        <a href="{{route('user.print',['type'=>'excel','name' => request()->name,'email' => request()->email,'phone' => request()->phone,'age' => request()->age, 'country' => request()->country])}}"
                           class="btn btn-secondary">EXCEL</a>
                    </div>
                </div>
                <div class="table-responsive">
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
                                       value="{{ request()->name }}">
                            </td>
                            <td><input type="text" name="email" class="form-control search"
                                       placeholder="Filter Email.." value="{{ request()->email }}"></td>
                            <td><input type="text" name="phone" class="form-control search"
                                       placeholder="Filter Phone.." value="{{ request()->phone }}"></td>
                            <td><input type="text" name="age" class="form-control search" placeholder="Filter Age.."
                                       value="{{ request()->age }}"></td>
                            <td><input type="text" name="country" class="form-control search"
                                       placeholder="Filter Country.." value="{{ request()->country }}"
                                ></td>
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
                                <td colspan="8" class="no-rec-found text-center"><b>No Record Found</b></td>
                            </tr>
                        @endforelse
                        <tr class="loading-icon d-none">
                            <td colspan="8" class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></td>
                        </tr>
                        </tbody>
                    </table>
                    {{ $users }}
                </div>
                <!-- User Add Modal Start-->
                <!-- Modal -->
                <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewUserModalLabel">Add New User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('user.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="name" class="mb-2">Name <strong
                                                class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               placeholder="Enter name">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email" class="mb-2">Email <strong
                                                class="text-danger">*</strong></label>
                                        <input type="email" class="form-control" name="email"
                                               aria-describedby="emailHelp" id="email"
                                               placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="phone" class="mb-2">Phone <strong
                                                class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" name="phone"
                                               aria-describedby="phoneHelp" id="phone"
                                               placeholder="Enter phone">
                                        <small id="phoneHelp" class="form-text text-muted">We'll never share your phone
                                            with anyone else.</small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="age" class="mb-2">Age <strong class="text-danger">*</strong></label>
                                        <input type="number" class="form-control" name="age" id="age"
                                               placeholder="Enter age">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="country" class="mb-2">Country</label>
                                        <input type="text" class="form-control" name="country" id="country"
                                               placeholder="Enter country">
                                    </div>
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Add Modal End-->
                <!-- User Edit Modal Start-->
                <!-- Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group mb-2">
                                        <label for="name" class="mb-2">Name <strong
                                                class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               placeholder="Enter name">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email" class="mb-2">Email <strong
                                                class="text-danger">*</strong></label>
                                        <input type="email" class="form-control" name="email"
                                               aria-describedby="emailHelp" id="email"
                                               placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="phone" class="mb-2">Phone <strong
                                                class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" name="phone"
                                               aria-describedby="phoneHelp" id="phone"
                                               placeholder="Enter phone">
                                        <small id="phoneHelp" class="form-text text-muted">We'll never share your phone
                                            with anyone else.</small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="age" class="mb-2">Age <strong class="text-danger">*</strong></label>
                                        <input type="number" class="form-control" name="age" id="age"
                                               placeholder="Enter age">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="country" class="mb-2">Country</label>
                                        <input type="text" class="form-control" name="country" id="country"
                                               placeholder="Enter country">
                                    </div>
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Edit Modal End-->
                <!-- User Delete Modal Start -->
                <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserModalLabel">User Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                @method('Delete')
                                <div class="modal-body">
                                    <p>Are you sure to remove this user?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- User Delete Modal End -->
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $("body").on("keyup", ".search", function (event) {
            $(".loading-icon").removeClass('d-none');
            $(".user-list").addClass('d-none');
            setTimeout(() => {
                var queryStr = '?';
                $(".search").each(function () {
                    if ($(this).val() != '') {
                        queryStr += $(this).attr('name') + "=" + ($(this).val()) + "&";
                    }
                });
                filterData(queryStr);
            }, 1000);
        });

        function filterData(queryStr) {
            $.ajax({
                url: "/" + queryStr,
                type: "get",
                success: function (data) {
                    $(".loading-icon").addClass('d-none');
                    $(".user-list").removeClass('d-none');
                    $("#ajaxUserList").html(data);
                },
                error: function (error) {
                    $(".loading-icon").addClass('d-none');
                    $(".user-list").removeClass('d-none');
                }
            });
        }

    </script>
@endpush

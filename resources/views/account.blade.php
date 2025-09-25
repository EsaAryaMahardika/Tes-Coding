@extends('layout')
@section('content')
<div class="body mt-5">
    <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#add">New Author</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover spacing5 tabel">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($account as $item)
                <tr>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <button 
                            class="btn btn-sm btn-warning btn-edit" 
                            data-toggle="modal" 
                            data-target="#editModal"
                            data-username="{{ $item->username }}"
                            data-name="{{ $item->name }}"
                        >Edit</button> |
                        <form action="/account/{{ $item->username }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure delete this account?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/account" method="post" class="form-group">
                    @csrf
                    <div class="mt-2">
                        <label for="">Username</label>
                        <input class="form-control" type="text" name="username" required>
                    </div>
                    <div class="mt-2">
                        <label for="">Name</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="mt-2">
                        <label for="">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="mt-2">
                        <label for="">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="mt-2">
                        <label for="">Username</label>
                        <input class="form-control" type="text" name="username" id="editUsername" required>
                    </div>
                    <div class="mt-2">
                        <label for="">Name</label>
                        <input class="form-control" type="text" name="name" id="editName" required>
                    </div>
                    <div class="mt-2">
                        <label for="">New Password</label>
                        <input class="form-control" type="text" name="password">
                    </div>
                    <div class="mt-2">
                        <label for="">Confirm Password</label>
                        <input class="form-control" type="text" name="password_confirmation">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const editForm = document.getElementById('editForm');
        const username = document.getElementById('editUsername');
        const name = document.getElementById('editName');

        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const user = this.getAttribute('data-username');
                const user_name = this.getAttribute('data-name');
                username.value = user;
                name.value = user_name;
                editForm.action = '/account/' + user;
            });
        });
    });
    </script>
@endsection
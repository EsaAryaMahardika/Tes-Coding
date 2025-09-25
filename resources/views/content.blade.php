@extends('layout')
@section('content')
<div class="body mt-5">
    <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#add">New Content</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover spacing5 tabel">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        <button 
                            class="btn btn-sm btn-warning btn-edit" 
                            data-toggle="modal" 
                            data-target="#editModal"
                            data-id="{{ $item->idpost }}"
                            data-title="{{ $item->title }}"
                            data-content="{{ $item->content }}"
                        >Edit</button> |
                        <form action="/content/{{ $item->idpost }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure delete this content?')">
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
                <h5 class="modal-title">New Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/content" method="post" class="form-group">
                    @csrf
                    <div class="mt-2">
                        <label for="">Title</label>
                        <input class="form-control" type="text" name="title" required>
                    </div>
                    <div class="mt-2">
                        <label for="">Content</label>
                        <textarea class="form-control" name="body" rows="10" required></textarea>
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
                <h5 class="modal-title">Edit Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="mt-2">
                        <label for="">Title</label>
                        <input class="form-control" type="text" name="title" id="editTitle" required>
                    </div>
                    <div class="mt-2">
                        <label for="">Content</label>
                        <textarea class="form-control" name="body" id="editContent" rows="10" required></textarea>
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
        // const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const editTitle = document.getElementById('editTitle');
        const editContent = document.getElementById('editContent');

        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const content = this.getAttribute('data-content');
                editTitle.value = title;
                editContent.value = content;
                editForm.action = '/content/' + id;
            });
        });
    });
    </script>
@endsection
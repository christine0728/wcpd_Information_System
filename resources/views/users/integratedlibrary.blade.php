<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Integrated Library System </title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('asset/favicon.ico') }}">
        <style>
            .filter {
                display: flex;
                align-items: center;
            }

            .date-filter {
                display: flex;
                align-items: center;
                margin-right: 10px;
            }

            .date-filter label {
                margin-right: 5px;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ __('Integrated Library System') }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info">
                            Integrated Library System
                            </div>
                            <div class="filter">
                                <form action="filter-integratedlibrary" method="GET">
                                    <div class="date-filter">
                                        <label for="start_date">From:</label>&nbsp;&nbsp;
                                        <input type="date" name="start_date" id="start_date" value="{{ $start_date ?? old('start_date') }}">&nbsp;&nbsp;
                                        <label for="end_date">To:</label>&nbsp;&nbsp;
                                        <input type="date" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}">&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary">Apply Filter</button>&nbsp;&nbsp;
                                        <a href="{{ route('integratedlibrary') }}"><button type="button" class="all-list btn btn-secondary">All</button></a>
                                    </div>
                                </form>
                            </div><br>

                            <div class="card" style="overflow-x: auto">
                                <div class="card-body p-1">
                                    <table id="example" class="display resposive nowrap mt-5 table-responsive-sm" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Intro</th>
                                                <th>Title</th>
                                                <th>Link</th>
                                                <th>Created By</th>
                                                <th>Created Date</th>
                                                <th>Modified By</th>
                                                <th>Modified Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 13px">
                                            @foreach($integrated as $integrate)
                                                <tr>
                                                    <td>{{ $integrate->intro }}</td>
                                                    <td>{{ $integrate->title }}</td>
                                                    <td>{{ $integrate->link }}</td>
                                                    <td>{{ $integrate->created_by_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($integrate->created_at)->format('F j, Y \a\t g:i a') }}</td>
                                                    <td>{{ $integrate->modified_by_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($integrate->updated_at)->format('F j, Y \a\t g:i a') }}</td>
                                                    <td>
                                                    <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $integrate->id }}" data-intro="{{ $integrate->intro }}" data-title="{{ $integrate->title }}" data-link="{{ $integrate->link }}" data-target="#modalEdit">
                                                        <button type="button" class="btn btn-success btn-xs">
                                                            <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer clearfix">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        @endsection
    </body>
</html>

@if(session('updatemessage'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Successfuly updated!',
        text: '{{ session('success') }}'
    });
</script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const modal = document.getElementById('modalEdit');
                const editId = this.getAttribute('data-id');
                const editIntro = this.getAttribute('data-intro');
                const editTitle = this.getAttribute('data-title');
                const editLink = this.getAttribute('data-link');

                document.getElementById('edit_id').value = editId;
                document.getElementById('edit_intro').value = editIntro;
                document.getElementById('edit_title').value = editTitle;
                document.getElementById('edit_link').value = editLink;

                $(modal).modal('show');
            });
        });
    });
</script>

<!-- Edit Organizational Structure Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Update Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('updateintegratedlibrary') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="form-group">
                        <label for="intro">Intro:</label>
                        <textarea class="form-control" id="edit_intro" name="edit_intro" required placeholder="Enter the intro"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title" required placeholder="Enter the title">
                    </div>
                    <div class="form-group">
                        <label for="link">Link:</label>
                        <textarea class="form-control" id="edit_link" name="edit_link" required placeholder="Enter the link"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
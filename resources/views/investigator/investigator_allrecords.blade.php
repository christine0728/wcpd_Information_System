<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Records</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <style>
            body {
                font-family: Arial, sans-serif;
            }


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
                            <h1 class="m-0">{{ __('All Records') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content">
                                <div class="container-fluid">
                                    {{-- <div class="row">
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                                                <i class="fas fa-plus"></i> Add Activity
                                            </button><br><br>
                                        </div>
                                    </div> --}}
                                    <!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </div>
                            {{-- <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalAddLabel">Add Announcement</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('add_activity') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="barcode">Activity title:</label>
                                                    <input type="text" class="form-control" id="activity_title" name="activity_title" required placeholder="Enter the activity title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="barcode">Status:</label>
                                                    <input type="text" class="form-control" id="status" name="status" required placeholder="Enter the accession">
                                                </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  --}}

                            {{-- <div class="card" style="overflow-x: auto;">
                                <div class="card-body p-1">
                                    <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>Activity title</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Created Date</th>
                                                <th>Modified By</th>
                                                <th>Modified Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 13px">
                                            @foreach($activities as $activity)
                                                <tr>
                                                    <td>{{ $activity->activity_title }}</td>
                                                    <td>{{ $activity->status}}</td>
                                                    <td>{{ $activity->created_by_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('F j, Y \a\t g:i a') }}</td>
                                                    <td>{{ $activity->modified_by_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($activity->updated_at)->format('F j, Y \a\t g:i a') }}</td>
                                                    <td>
                                                    <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete('{{ $activity->id }}')">
                                                    <i style="color: white; font-size: 12px;" class="fas fa-trash-alt"></i>
                                                    </button>
                                                    <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $activity->id }}" data-activity_title="{{ $activity->activity_title }}" data-status="{{ $activity->status }}" data-image="" data-target="#modalEdit">
                                                        <button type="button" class="btn btn-success btn-xs">
                                                            <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> --}}
                                <!-- /.card-body -->

                                <div class="card-footer clearfix">

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
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure to delete this book?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/admin/activity_destroy/' + id,
                data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
                },
                success: function (response) {
                Swal.fire(
                    'Deleted!',
                    'The record has been deleted.',
                    'success'
                ).then(function () {
                    location.reload();
                });
                },
                error: function (error) {
                    console.log(error);
                Swal.fire(
                    'Error!',
                    'An error occurred while deleting the record.',
                    'error'
                );
                }
            });
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const modal = document.getElementById('modalEdit');
                const editId = this.getAttribute('data-id');
                const editactivity_title = this.getAttribute('data-activity_title');
                const editstatus = this.getAttribute('data-status');

                document.getElementById('edit_id').value = editId;
                document.getElementById('edit_activity_title').value = editactivity_title;
                document.getElementById('edit_status').value = editstatus;

                document.getElementById('edit_id').value = editId;

                $(modal).modal('show');
            });
        });
    });

</script>

<!-- Edit Organizational Structure Modal -->
{{-- <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Update Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('update_activity') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="edit_id" name="edit_id">
                    </div>
                    <div class="form-group">
                        <label for="barcode">Activity title:</label>
                        <input type="text" class="form-control" id="edit_activity_title" name="edit_activity_title" required placeholder="Enter the activity_title">
                    </div>
                    <div class="form-group">
                        <label for="barcode">Status:</label>
                        <input type="text" class="form-control" id="edit_status" name="edit_status" required placeholder="Enter the status">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

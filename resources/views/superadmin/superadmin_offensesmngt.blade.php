{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team | Complaint Report Management</title>
</head>
<body>
    <h1>Complaint Report Management</h1>

    <a href="{{ route('investigator.complaintreport_form') }}">Add Complaint Report (diretso sa Complaint Report Form)</a>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Offenses Management</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=26">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

        <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

        <style>  
            @media only screen and (max-width: 768px) {
                /* For mobile phones: */
                [class*="col-"] {
                width: 100%;
                }
                
                div{
                    display: none !important;
                }
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
                         <div class="col-6">
                            <h1 class="m-0" style="font-weight: bold">{{ __('Offenses Management') }}</h1>
                        </div> 
                    </div>
                </div>
            </div>
 
            <div class="content" style="margin-top: -2rem">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                                        <i class="fas fa-plus"></i> Add Activity
                                    </button><br><br> --}}

                                    <button type="button" class="form-buttons" data-toggle="modal" data-target="#exampleModal" style="width: 8rem">
                                        Add Offense&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div> 
                    
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">

                        @if(Session::has('delete')) 
                            <div class="alert delete" role="alert">
                                <b>{{ session::get('delete') }}</b>
                            </div>
                        @endif

                        <div class="card-body p-1">
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>  
                                        <th>Offense Name</th>
                                        {{-- <th>Description</th>  --}}
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($offenses as $offense)  
                                    <tr>   
                                        <td>{{ $offense->offense_name }}</td> 
                                        <td>{{ $offense->created_at }}</td>
                                        <td>
                                        <center> 
                                            <a  class="edit-btn" data-toggle="modal" data-id="{{ $offense->id }}" data-offense="{{ $offense->offense_name }}" data-desc="{{ $offense->description }}" data-target="#modalEdit">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a> 

                                            <a class="delete-btn" onclick="return confirm('Are you sure you want to DELETE this record?')" href="{{ route('superadmin.delete_offense', $offense->id) }}">&nbsp;&nbsp;&nbsp;Delete <i class="fa fa-trash" style="font-size: large; padding: 0.5rem"></i></a>
                                        </center>
                                        </td>
                                    </tr> 
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                             
                        </div>
                    </div>
                </div>
            </div> 
            
            <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Offense</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('superadmin.edit_offense') }}" method="post">
                            <div class="modal-body">
                             @csrf
                              <input type="hidden" name="edit_id" id="edit_id">
                              <div class="form-group">
                                    <label class="req-label">Offenses:</label>
                                    <input type="text" class="form-control" name="edit_offense" id="edit_offense">
                              </div>
                              <div class="form-group">
                                    <label class="req-label">Description</label>
                                    <input type="text" class="form-control" name="edit_desc" id="edit_desc">
                              </div>       
                            <div class="modal-footer">
                                <button type="button" class="form-buttons" data-dismiss="modal" style="background-color: red">Close&nbsp;&nbsp;<i class="fa-solid fa-xmark"></i></button>
                                <button type="submit" class="form-buttons">Save Changes&nbsp;&nbsp;<i class="fa-solid fa-check"></i></button>  
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Offense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('superadmin.add_offense') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="offenseNameInput">Offense Name:</label>
                                <input type="text" class="form-control" id="offenseNameInput" name="offense_name" oninput="toUpper(this)" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="descriptionInput">Description:</label>
                                <input type="text" class="form-control" id="descriptionInput" name="description" oninput="toUpper(this)" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="form-buttons" data-dismiss="modal" >Close&nbsp;&nbsp;<i class="fa-solid fa-xmark"></i></button>
                            <button type="submit" class="form-buttons">Save Changes&nbsp;&nbsp;<i class="fa-solid fa-check"></i></button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        @endsection
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>   
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const modal = document.getElementById('modalEdit');
                const editId = this.getAttribute('data-id');
                const editoffense = this.getAttribute('data-offense');
                const editdesc = this.getAttribute('data-desc');
                console.log(editdesc);
                document.getElementById('edit_id').value = editId;
                document.getElementById('edit_offense').value = editoffense;
                document.getElementById('edit_desc').value = editdesc; 
                $(modal).modal('show');
            });
        });
    });

</script>

<script>
    $(document).ready(function() {
          $('#compsTbl').DataTable({
            "order": [[0, "desc"]]
          });
      });

      document.getElementById('modalForm').addEventListener('submit', function(event) {
        var form = event.target;
        if (!form.checkValidity()) {
            event.preventDefault();  
            event.stopPropagation();
        }
        form.classList.add('was-validated');  
    });
</script>

<script>
    let inactiveTime = 0;
    const logoutTime = 5 * 60 * 1000;
    // 5 * 60 * 1000; // 5 minutes in milliseconds
    
    function resetInactiveTime() {
        inactiveTime = 0;
    }
    
    function handleUserActivity() {
        resetInactiveTime();
    }
    
    document.addEventLisstener('mousemove', handleUserActivity);
    document.addEventListener('keydown', handleUserActivity);
    
    function checkInactiveTime() {
        inactiveTime += 1000; 
        if (inactiveTime >= logoutTime) { 
            window.location.href = "/inactive_screen"; 
        } else { 
            setTimeout(checkInactiveTime, 1000); 
        }
    }
    
    setTimeout(checkInactiveTime, 1000); // Check every 1 second initially

</script>
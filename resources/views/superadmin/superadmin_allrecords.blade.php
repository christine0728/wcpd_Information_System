<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Superadmin | All Records</title>
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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                            <h1 class="m-0">&nbsp;<b>{{ __('All Records') }}</b></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="filter">
                            <form action="filter-allrecords" method="GET">
                            <div class="date-filter">
                                <label for="start_date">From:</label>&nbsp;&nbsp;
                                <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                <label for="end_date">To:</label>&nbsp;&nbsp;
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                <a href="{{ route('superadmin.allrecords') }}"><button type="button" class="link-buttons" style="background-color: #48145B"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">
                        <div class="card-body p-1">
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th style="display: none">id</th>
                                        <th>View</th>
                                        <th>Complaint Report Author</th>
                                        <th>Case Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comps as $comp)
                                    <tr>
                                        <td style="display: none">{{ $comp->id }}</td>
                                        <td style="vertical-align: top;">
                                            <a class="view-btn" href="{{ route('superadmin.readonly_complaintreport', $comp->id) }}" target="_blank">&nbsp;&nbsp;&nbsp;View <i class="fa-regular fa-eye" style="font-size: large; padding: 0.5rem"></i></a>
                                        </td>
                                        <td style="vertical-align: top;">{{ $comp->username }} ({{ $comp->team }})</td>
                                        <td>
                                            <b>Date Reported:</b> {{ $comp->date_reported }}
                                            <br><b>Investigation/Case No.:</b> {{ $comp->inv_case_no }}
                                            <br><b>Place of Commission:</b> {{ $comp->place_of_commission }}
                                            <br><b>Offenses Committed:</b> {{ $comp->offenses }}
                                            <br><b>Motive/Cause:</b> {{ $comp->evidence_motive_cause }}
                                            <br><b>Case Disposition:</b> {{ $comp->case_disposition }}
                                            <br><b>Suspect Disposition:</b> {{ $comp->suspect_disposition }}
                                            <br><b>Case Update:</b>
                                                @if ($comp->case_update == null)
                                                    Case not updated yet.
                                                @else
                                                    {{ $comp->case_update }}
                                                @endif
                                            <br><b>Date of Case Updated:</b>
                                                @if ($comp->case_update == null)
                                                    Case not updated yet.
                                                @else
                                                    {{ $comp->date_case_updated }}
                                                @endif
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
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    var currentDate = yyyy + '-' + mm + '-' + dd;
    document.getElementById('end_date').value = currentDate;
</script>


<script>
    var myInput1 = document.getElementById("myInput1");

    var storedValue1 = localStorage.getItem("myInputValue1");

    if (storedValue1) {
        myInput1.value = storedValue1;
    }

    myInput1.addEventListener("input", function() {
        localStorage.setItem("myInputValue1", myInput1.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
    var inputElement = document.getElementById('myInput1');
    inputElement.value = '';
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

    document.addEventListener('mousemove', handleUserActivity);
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

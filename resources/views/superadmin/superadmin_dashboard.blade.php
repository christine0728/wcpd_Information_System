<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SuperAdmin | Dashboard</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
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

            @media only screen and (max-width: 768px) {
                /* For mobile phones: */
                [class*="col-"] {
                width: 100%;
                }

                div{
                    display: none !important;
                }
            }

            .notif div:hover{
                background-color: #f0f0f0 !important;
                border-radius: 0.5rem !important;
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
                        <h1 class="m-0" style="font-weight: bold;">&nbsp;{{ __('Dashboard') }}</h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="content" style="margin-top: 1rem; ">
            <div class="container-fluid" >
                <div class="row col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: -1.5rem; margin-bottom: 2rem; padding: 1rem">
                    <div class="col-12">
                        <div class="filter">
                            <form action="filter-dashboard" method="GET">
                            <div class="date-filter">
                                <label for="start_date">From:</label>&nbsp;&nbsp;
                                <input type="month" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}">&nbsp;&nbsp;
                                <label for="end_date">To:</label>&nbsp;&nbsp;
                                <input type="month" class="form-control" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}">&nbsp;&nbsp;
                                <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                {{-- <a href="{{ route('superadmin.allrecords') }}"><button type="button" class="link-buttons" style="background-color: #48145B">All</button></a> --}}
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="chart_div" style="width: 100%; height: 15rem;"></div>

                                <button id="download-button" class="form-buttons" style="width: 13rem; margin-top: 1rem">Download Monthly Data&nbsp;&nbsp;<i class="fa-solid fa-download"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large"> TOTAL NUMBER OF RECORDS PER RELATIONSHIP OF VICTIM TO SUSPECT PER GENDER </b>
                                </div>
                                <table id="compsTbl">
                                    <thead>
                                        <tr>
                                            <th>RELATIONSHIP </th>
                                            <th>Male Count</th>
                                            <th>Female Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($relationshipCounts as $item)
                                            <tr>
                                                <td>{{ $item->offender_relationship_victim }}</td>
                                                <td>{{ $item->male_count }}</td>
                                                <td>{{ $item->female_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
<<<<<<< Updated upstream
                    </div>

                    {{-- <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; ">
                                <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Case</th>
                                            @foreach($comps as $comp)
                                                <th>{{ $comp->comp_month }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comps as $comp)
                                            <tr>
                                                <td>
                                                    {{ $comp->offense }}
                                                </td>
                                                @foreach($comps as $comp)
                                                <td>Male: {{ $comp->male_total_comps }}
                                                    <br>Female: {{ $comp->female_total_comps }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
=======
                    </div> 
>>>>>>> Stashed changes

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large">TOTAL NUMBER OF CASES PER AGE RANGE IN FEMALE</b>
                                </div>
                                <br><div class="pie-chart_fem" id="pie-chart_fem"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large">TOTAL NUMBER OF CASES PER AGE RANGE IN MALE</b>
                                </div>
                                <br><div class="pie-chart_male" id="pie-chart_male"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large">TOTAL NUMBER OF VICTIMS PER GENDER</b>
                                </div>
                                <br><div id="pie_chart" ></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large"> TOTAL NUMBER OF OFFENDERS PER GENDER</b>
                                </div>
                                <br><div id="pie_chart5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large">TOP FIVE PLACES WITH MOST NUMBER OF CASE</b>
                                </div>
                                <div id="chart_div1" ></div>
                            </div>
                        </div>
<<<<<<< Updated upstream
                    </div>


                    {{-- <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;  border-radius: 0.5rem; ">
                                <div>
                                    <b style="color: #48145B; font-size: large"> TOTAL NUMBER OF RECORDS PER RELATIONSHIP OF VICTIM TO SUSPECT PER GENDER </b>
                                </div>
                                <table id="compsTbl">
                                    <thead>
                                        <tr>
                                            <th>RELATIONSHIP </th>
                                            <th>Male Count</th>
                                            <th>Female Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($relationshipCounts as $item)
                                            <tr>
                                                <td>{{ $item->offender_relationship_victim }}</td>
                                                <td>{{ $item->male_count }}</td>
                                                <td>{{ $item->female_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> --}}

                    <div class="card-footer clearfix">
=======
                    </div> 
                   
                    <div class="card-footer clearfix"> 
>>>>>>> Stashed changes
                    </div>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

$(document).ready(function() {
          $('#compsTbl').DataTable({
            "order": [[0, "desc"]]
          });
      });


</script>
<script>
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Male', 'Female'],
            @foreach($comps as $comp)
                ['{{ $comp->comp_month }}',
                {{ $comp->male_total_comps ?? 0 }},
                {{ $comp->female_total_comps ?? 0 }}
                ],
            @endforeach
        ]);

        var options = { 
            bars: 'vertical'  
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

<<<<<<< Updated upstream
        chart.draw(data, google.charts.Bar.convertOptions(options));

        // Function to download chart data as CSV
=======
        chart.draw(data, google.charts.Bar.convertOptions(options)); 
         
>>>>>>> Stashed changes
        function downloadCSV() {
            var csvContent = google.visualization.dataTableToCsv(data);
            var encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
            var link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', 'chart_data.csv');
            document.body.appendChild(link);
            link.click();
        }

        // Add event listener to the download button
        document.getElementById('download-button').addEventListener('click', function() {
            downloadCSV();
        });
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data3 = new google.visualization.DataTable();
        data3.addColumn('string', 'Age Range');
        data3.addColumn('number', 'Total Complaints');

        var rawData = {!! json_encode($comps11) !!}; // Ensure proper JSON encoding

        rawData.forEach(function(row) {
            data3.addRow([row.age_range, row.total_comps]);
        });

        var options3 = {
            title: 'Complaints by Age Range',
            is3D: false,
            chartArea: {
                left: 50,
                right: 50,
                width: '100%',
                height: '100%'
            },
            fontSize: 15,
            legend: {
                position: 'left',
                fontSize: 15,
                textStyle: {
                    fontSize: 15
                }
            },
            pieSliceTextStyle: {
                fontSize: 15
            },
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('pie-chart_fem'));
        chart3.draw(data3, options3);

        var data_male = new google.visualization.DataTable();
        data_male.addColumn('string', 'Age Range');
        data_male.addColumn('number', 'Total Complaints');

        var rawDatam = {!! json_encode($comps_male) !!};

        rawDatam.forEach(function(row) {
            data_male.addRow([row.age_range, row.total_comps]);
        });

        var options_male = {
            title: 'Complaints by Age Range',
            is_3D: false,
            chartArea: {
                left: 50,
                right: 50,
                width: '100%',
                height: '100%'
            },
            fontSize: 15,
            legend: {
                position: 'left',
                fontSize: 15,
                textStyle: {
                    fontSize: 15
                }
            },
            pieSliceTextStyle: {
                fontSize: 15
            },
        };

        var chart_male = new google.visualization.PieChart(document.getElementById('pie-chart_male'));
        chart_male.draw(data_male, options_male);
<<<<<<< Updated upstream
    }
</script>
{{-- <script>
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

</script> --}}
=======
    }  
</script> 
>>>>>>> Stashed changes
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Gender', 'Count'],
            ['Male', {{ $maleVictim }}],
            ['Female', {{ $femaleVictim }}]
        ]);

        var options = {
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Gender', 'Count'],
            ['Male', {{ $maleOffenders }}],
            ['Female', {{ $femaleOffenders }}]
        ]);

        var options = {
            is3D: true,
            pieSliceText: 'percentage',
            backgroundColor: 'transparent',
            chartArea: {
                left: 10,
                top: 10,
                width: '100%',
                height: '100%'
            },
            pieSliceTextStyle: {
                fontSize: 15
            },
            fontSize: 15,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_chart5'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Place');
        data.addColumn('number', 'Total Cases');

        var topPlaces = {!! json_encode($topPlaces) !!};
        var rows = [];
        topPlaces.forEach(function(place) {
            rows.push([place.place_of_commission, parseInt(place.total_cases)]);
        });

        data.addRows(rows);

        var options = {
            legend: { position: 'none' },
            chartArea: { width: '50%' },
            hAxis: {
                title: 'Total Number Cases',
                minValue: 0,
            },
            vAxis: {
                title: 'Place',
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }
</script>


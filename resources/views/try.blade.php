<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Covid19 - Kosovo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel= "stylesheet" href="/css/style.css">
</head>
<body>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.cookie/1.4.0/jquery.cookie.min.js"></script>

        



<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Exodus AAB Project
                </a>
            </li>
            <li>
                <a href="/">Dashboard</a>
            </li>
            <li>
                <a href="#">Login</a>
            </li>
            <li>
                <a href="/map">Map</a>
            </li>
            <li>
                <a href="/heat">Heatmap</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- todo MAP COVERAGE -->
                    <h1>Corona Virus in Kosovo ( Statistics )</h1>
    
                    <div id="totalConfirmed">Total Confirmed: </div>
                    <div id="totalDeaths">Total Deaths: </div>
                    <div id="totalRecovered">Total Recovered: </div>
                    <div id="newRecovered">New Recovered: </div>
                    
                
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>

    <script>
        var settings = {
        "url": "https://api.covid19api.com/summary",
        "method": "GET",
        "timeout": 0,
        };

        //KOSOVOs ID right now is 136 - Can change through time. TODO --Automate

        $.ajax(settings).done(function (response) {
        console.log(response);
        var deaths = response.Countries[136].TotalDeaths;
        $("#totalDeaths").append(deaths);

        var confirmed = response.Countries[136].TotalConfirmed;
        $("#totalConfirmed").append(confirmed);

        var recovered = response.Countries[136].TotalRecovered;
        $("#totalRecovered").append(recovered);

        var newRecovered = response.Countries[136].NewRecovered;
        $("#newRecovered").append(newRecovered);
        });
   </script>

    
</body>
</html>
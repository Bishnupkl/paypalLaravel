
<!DOCTYPE html>
<html>
  <head>
    <title>Showing Elevation Along a Path</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://www.google.com/jsapi"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABq5SExRGoMmOFNgSyGM_UrfNHBGQ3c38&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      #elevation_chart{
        display: none;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      // Load the Visualization API and the columnchart package.
      google.load("visualization", "1", { packages: ["columnchart"] });

      function initMap() {
        // The following path marks a path from Mt. Whitney, the highest point in the
        // continental United States to Badwater, Death Valley, the lowest point.
        const path = [
        

               <?php 
               if(isset($gps) && count($gps)>0){
                
          foreach ($gps as $key => $gp) {    
           
            ?>
            { lat: <?php echo $gp['lat'];?>, lng: <?php echo $gp['lon'];?> },
          <?php }}?>



        ]; // Badwater, Death Valley

        if(path.length==1){
          path[1]=path[0];
        }
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 13.2,
          center: path[1],
          mapTypeId: "terrain",
        });
        // Create an ElevationService.
        const elevator = new google.maps.ElevationService();
        // Draw the path, using the Visualization API and the Elevation service.
        displayPathElevation(path, elevator, map);
        new google.maps.Marker({


        <?php if(count($gps)>0){ 

          ?>
         
            position: { lat: <?php echo $gps[0]['lat'];?>, lng: <?php echo $gps[0]['lon'];?> },
          


         
          // position: myLatLng,
          map,
          title: "Battery:<?php echo $gps[0]['batteryLvl'];?>%",
          <?php } ?>
        });
          new google.maps.Marker({
            <?php if (count($gps)>0 ) { ?>
            position: { lat: <?php echo $gps[count($gps)-1]['lat'];?>, lng: <?php echo $gps[count($gps)-1]['lon'];?> },
        
        
          // position: myLatLng,
          map,
          title: "Battery:<?php echo $gps[count($gps)-1]['batteryLvl'];?>%",
            <?php } ?>
        });
      }

      function displayPathElevation(path, elevator, map) {
        // Display a polyline of the elevation path.
        new google.maps.Polyline({
          path: path,
          strokeColor: "#0000CC",
          strokeOpacity: 0.4,
          map: map,
        });
        // Create a PathElevationRequest object using this array.
        // Ask for 256 samples along that path.
        // Initiate the path request.
        elevator.getElevationAlongPath(
          {
            path: path,
            samples: 256,
          },
          plotElevation
        );
      }

      // Takes an array of ElevationResult objects, draws the path on the map
      // and plots the elevation profile on a Visualization API ColumnChart.
      function plotElevation(elevations, status) {
        const chartDiv = document.getElementById("elevation_chart");

        if (status !== "OK") {
          // Show the error code inside the chartDiv.
          chartDiv.innerHTML =
            "Cannot show elevation: request failed because " + status;
          return;
        }
        // Create a new chart in the elevation_chart DIV.
        const chart = new google.visualization.ColumnChart(chartDiv);
        // Extract the data from which to populate the chart.
        // Because the samples are equidistant, the 'Sample'
        // column here does double duty as distance along the
        // X axis.
        const data = new google.visualization.DataTable();
        data.addColumn("string", "Sample");
        data.addColumn("number", "Elevation");

        for (let i = 0; i < elevations.length; i++) {
          data.addRow(["", elevations[i].elevation]);
        }
        // Draw the chart using the data within its DIV.
        chart.draw(data, {
          height: 150,
          legend: "none",
          titleY: "Elevation (m)",
        });
      }

    </script>
  </head>
  <body>
    <div>
       <div class="container-fluid">

      <div class="row">
        <h2><center>{{$user->first_name}} {{$user->last_name}} GPS Locations</center></h2>
        
      </div>
      <div class="row" style="width:100%;
      height:500px;">
      <div class="col-md-4" style="background-color: #f6921e;">
        <h2>Date Range</h2>
        <form method="post" action="{{route('gps.date-range')}}">
          {{csrf_field()}}
          <input type="hidden" name="email" value="{{$user->email}}">
          <div class="mb-3">
            <label for="" class="form-label">From</label>
            <input type="datetime-local" class="form-control" name="from">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">To</label>
            <input type="datetime-local" class="form-control" name="to">
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="col-md-8">
        @if(isset($gp) && count($gps)>0)
        <div id="map"></div>
         <div id="elevation_chart"></div>
        @else
        <br><br><br>
        <div><strong>No Gps locations for today</strong></div>
        @endif
      </div>
    </div>
  </div>
     
    </div>
  </body>
</html>
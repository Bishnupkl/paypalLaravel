	<!DOCTYPE html>
<html>
<head>
  <title>Gps Map</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABq5SExRGoMmOFNgSyGM_UrfNHBGQ3c38&callback=initMap&libraries=&v=weekly"
  defer
  ></script>
  <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
        height: 100%;
        width: 100%
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
      let map;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          <?php 
          foreach ($gps as $key => $gp) {    
            ?>
            center: { lat: <?php echo $gp['lat'];?>, lng: <?php echo $gp['lon'];?> },
          <?php }?>

          zoom: 18,
        });
        new google.maps.Marker({
          <?php 
          foreach ($gps as $key => $gp) {    
            ?>
            position: { lat: <?php echo $gp['lat'];?>, lng: <?php echo $gp['lon'];?> },
          <?php }?>
          // position: myLatLng,
          map,
          title: "Hello World!",
        });
      } 
    </script>
  </head>
  <body>
    <div class="container-fluid">

      <div class="row">
        <h2><center>{{$user->first_name}} {{$user->last_name}} GPS Locations</center></h2>
      </div>
      <div class="row" style="width:100%;
      height:600px;">
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
        @else
        <br><br><br>
        <div><strong>No Gps locations for today</strong></div>
        @endif
      </div>
    </div>
  </div>
  <!-- {{$user}} -->

</body>
</html>
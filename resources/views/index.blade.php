<!DOCTYPE html>
<html style="min-height: 100vh;">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<title></title>


    <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap ver 3.3.6 --> 
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">


	<!-- <link href="templates/registration.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">

        
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/form-elements.css">
        <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/tabbedcon.css">
    <link rel="stylesheet" href="css/texthide.css">
    <link href="css/registration.css" rel="stylesheet">
    

    <script src="js/googleMap.js"></script>
    
    <!--bower components -->
    <script src="vendor/angular/angular.min.js"></script> 
    <script src="vendor/angular-ui-router/release/angular-ui-router.min.js"></script> 
    <script src="vendor/angularUtils-pagination/dirPagination.js"></script>
    <script src="vendor/ng-backstretch/dist/ng-backstretch.js"></script>
    <script src="vendor/ngmap/build/scripts/ng-map.min.js"></script>
    <script src="js/ngStorage.min.js"></script>
 
    <!-- your app's js -->
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/services.js"></script>
    <script src="js/tabbedcon.js"></script>
<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHFeZmCq350xL4BAMgH4WA9LboR2vlWmo&callback=initMap"
    async defer></script>-->
    
    <!--jQuery-->
<!--      <script src="templates/assets/js/jquery-1.11.1.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   
  
	<!--Bootstrap-->
	<script src="{{URL::asset(`js/bootstrap.min.js`)}}"></script>

	<script src="{{URL::asset(`templates/registration.js`)}}"></script>

	<!-- Javascript -->


	<script src="js/jquery.backstretch.min.js"></script>
	<script src="js/scripts.js"></script>

	

</head>

<body ng-app="starter" style="min-height: 100vh;">
	<!--     <div ui-view="header"></div>-->
	<!--      <div ng-controller="bgCtrl" backstretch backstretch-images="bgImage">-->
	<div ui-view style="min-height: 100vh;">

	</div>

	<!--      </div>-->
	<!--      <div ui-view="footer"></div>-->
</body>

</html>
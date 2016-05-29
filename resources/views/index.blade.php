<!DOCTYPE html>
<html ng-app='developerMaze'>
<head>
	<!--angular scripts-->
	<script src="js/angular.min.js"></script>
	<script src="js/angular-route.min.js"></script>
	
	<!--Angular-read-more module-->
	<script src="bower_components/angular-read-more/dist/readmore.js"></script>
	<script src="bower_components/angular-sanitize/angular-sanitize.min.js"></script>
	<script src="bower_components/angular-animate/angular-animate.min.js"></script>

	<script src="js/app.js"></script>
	<script src="js/sessionService.js"></script>
	<script src="js/homecontroller.js"></script>
	<script src="js/questionscontroller.js"></script>
	<script src="js/headercontroller.js"></script>
	<script src="js/questioncontroller.js"></script>
	<script src="js/directives.js"></script>
	<script src="js/coursecontroller.js"></script>


	<!--bootstrap and jquery-->
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="jquery/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <link href="/bootstrap/css/simple-sidebar.css" rel="stylesheet">

    <!--bootstrap UI-->
    <script src="js/ui-bootstrap-tpls-1.3.3.min.js"></script>
	
	<script src="js/factory.js"></script>

	<!--codemirror scripts-->
	<link rel="stylesheet" type="text/css" href="bower_components/codemirror/lib/codemirror.css">
	<script type="text/javascript" src="bower_components/codemirror/lib/codemirror.js"></script>
	<script type="text/javascript" src="bower_components/angular-ui-codemirror/ui-codemirror.js"></script>

	<meta name="csrf-token" value="<?= csrf_token() ?>">


	<!--Angular Trix -->
	<link rel="stylesheet" type="text/css" href="bower_components/trix/dist/trix.css">
	<script src="bower_components/trix/dist/trix.js"></script>
	<script src="bower_components/angular-trix/dist/angular-trix.min.js"></script>

	<!--auto complete scripts-->
    <link rel="stylesheet" href="css/autocomplete.css">
    <script type="text/javascript" src="js/autocomplete.js"></script>

    <script src='bower_components/angular-file-model/angular-file-model.js'></script>

    <!-- Basic stylesheet -->
	<link rel="stylesheet" href="owl-carousel/owl.carousel.css">

	 <!-- Default Theme -->
	<link rel="stylesheet" href="owl-carousel/owl.theme.css">

	<!-- Include js plugin -->
	<script src="owl-carousel/owl.carousel.js"></script>


</head>

<body>
<div class="container">
	<div ng-view></div>
</div>
</body>

</html>
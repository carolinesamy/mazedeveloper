angular.module('developerMaze',['ngRoute','ui.bootstrap']);

angular.module('developerMaze').config(function($routeProvider){

	$routeProvider.when('/',{
		templateUrl:'templates/views/home.html',
		controller:'homeCtl'
	})

	.when('/questions',{
		templateUrl:'templates/views/questions.html',
		controller:'questionsCtl'
	})


	
	
})
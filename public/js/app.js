angular.module('developerMaze',['ngRoute']);

angular.module('developerMaze').config(function($routeProvider){

	$routeProvider.when('/',{
		templateUrl:'templates/views/home.html',
		controller:'firstCtl'
	})

	
	
})
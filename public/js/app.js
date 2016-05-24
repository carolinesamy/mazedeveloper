angular.module('developerMaze',['ngRoute','ui.bootstrap']);

angular.module('developerMaze').config(function($routeProvider){

	$routeProvider.when('/',{
		templateUrl:'templates/views/home.html',
		controller:'firstCtl'
	})

	
	
})
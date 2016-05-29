angular.module('developerMaze').controller('courseCtl',function( $scope ,$http, $rootScope,$routeParams){

	console.log($routeParams.id);
	$scope.course_id = $routeParams.id;//here we need http request to get this course's data

 //    $scope.course = {
 //        'course_name':'php',
 //        'course_id':$routeParams.id
 //    }

 //    $scope.courses =[
	// {
	// 	course_name:'PHP',
	//  	course_id:1
	// },
	// {
	// 	course_name:'Laravel',
	//  	course_id:2
	// },
	// {
	// 	course_name:'AngularJS',
	//  	course_id:4
	// },
	// {
	// 	course_name:'Bootstrap',
	//  	course_id:5
	// },
	// ];


})


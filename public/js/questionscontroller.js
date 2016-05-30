
angular.module('developerMaze').controller('questionsCtl',function( $scope ,$http, sessionService,$location, $rootScope , server){


	//user's courses
	// $scope.courses =[{"id":"1","course_name":"php"},{"id":"2","course_name":"java"}];
	// //recent questions in his courses
	// $scope.questions = [
	// 	{
	// 	'id':1,
	// 	'title':"HTML tags doesn't work",
	// 	'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
	// 	'answers':20
	// 	},
	// 	{
	// 	'id':2,
	// 	'title':"how to install Laravel in ubuntu??",
	// 	'answers':7,
	// 	'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas."
	// 	},
	// 	{
	// 	'id':3,
	// 	'title':"i can't upload image using PHP",
	// 	'answers':3,
	// 	'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas."
	// 	}
	// ];

	$scope.requestData=function(){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/getuserdata',
			data: {
				'user': sessionService.get('user'),
				'type':sessionService.get('type')
			}
		}).success(function(res){
			//handle the returned data here
			console.log(res);
			$rootScope.courses = JSON.parse(res.user['course_data']);
			$rootScope.questions = JSON.parse(res.user['latest_follow_question']);
			$rootScope.allquestions = JSON.parse(res.user['latest_all_question']);
			$rootScope.numOfnotification = res.user['notification_num'];

		}).error(function(err){
			console.log(err);
		});
	}
	
	$scope.requestData();



})
angular.module('developerMaze').controller('courseCtl',function( $scope ,$http, $rootScope,sessionService,$routeParams){

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

	$scope.requestData=function(){
		//console.log('hello from controller');
		$http({
			method: 'POST',
			url: 'http://localhost:8000/getuserdata',
			data: {
				'user': sessionService.get('user'),
				'type':sessionService.get('type')
			}
		}).success(function(res){

			$rootScope.courses = JSON.parse(res.user['course_data']);
			$rootScope.questions = JSON.parse(res.user['latest_follow_question']);
			$rootScope.numOfnotification = res.user['notification_num'];
		}).error(function(err){
			console.log(err);
		});
	}
	
	$scope.requestData();


})


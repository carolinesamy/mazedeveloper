
angular.module('developerMaze').controller('questionsCtl',function( $scope ,$http, sessionService,$location, $rootScope , server){


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
			//$rootScope.numOfnotification = res.user['notification_num'];

		}).error(function(err){
			console.log(err);
		});
	}
	
	$scope.requestData();



})
angular.module('developerMaze').controller('inboxCtl',function( socket,$scope,$location ,$http, $rootScope,sessionService){



//*************************Request Data*******************************

	$scope.requestData=function(){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/getuserdata',
			data: {
				'user': sessionService.get('user'),
				'type':sessionService.get('type')
			}
		}).success(function(res){

			console.log(res);
			if(res){
				$rootScope.courses = JSON.parse(res.user['course_data']);
				$rootScope.questions = $rootScope.questionsWithoutFilter = JSON.parse(res.user['latest_follow_question']);
				$rootScope.allquestions = $rootScope.allquestionsWithoutFilter = JSON.parse(res.user['latest_all_question']);
				
			}
			
		}).error(function(err){
			console.log(err);
		});
	}

	$scope.requestData();	


	//*************************************************************


});
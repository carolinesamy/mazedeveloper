
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

			console.log(res);

			$rootScope.courses = JSON.parse(res.user['course_data']);
			$rootScope.questions = $rootScope.questionsWithoutFilter = JSON.parse(res.user['latest_follow_question']);
			$rootScope.allquestions = JSON.parse(res.user['latest_all_question']);

		}).error(function(err){
			console.log(err);
		});
	}
	
	$scope.requestData();

	 

	$scope.filterQuestions = function(status){

		$rootScope.questions = $rootScope.questionsWithoutFilter;

		questions=[];
		if(status== 'answered'){
		
			angular.forEach( $rootScope.questionsWithoutFilter, function(value , key){
				if(value['answer_number'] > 0){
					questions.push(value) ; 
				}
			} );
			$rootScope.questions = questions;

		}else if(status == 'unanswered'){

			angular.forEach( $rootScope.questionsWithoutFilter, function(value , key){
				if(value['answer_number'] == 0){
					questions.push(value) ; 
				}
			} );
			$rootScope.questions = questions;

		}else if(status == 'all'){

			$rootScope.questions = $rootScope.questionsWithoutFilter;

		}
	}



})
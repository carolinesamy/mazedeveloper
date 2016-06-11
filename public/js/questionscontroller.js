
angular.module('developerMaze').controller('questionsCtl',function( $scope,ngTableParams ,$http,$sce, sessionService,$location, $rootScope , server , $routeParams){
	

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
				console.log(res);
				$rootScope.courses = JSON.parse(res.user['course_data']);
				$rootScope.questions = $rootScope.questionsWithoutFilter = JSON.parse(res.user['latest_follow_question']);
				$rootScope.allquestions = $rootScope.allquestionsWithoutFilter = JSON.parse(res.user['latest_all_question']);

				$rootScope.questions = $rootScope.questions.map(function(item){
				item.content = $sce.trustAsHtml(item.content)
				return item;
				});
				$rootScope.allquestions = $rootScope.allquestions.map(function(item){
				item.content = $sce.trustAsHtml(item.content)
				return item;
				});

				$scope.questionsTable = new ngTableParams({
                page: 1,
                count: 6
	            }, {
	                total: $rootScope.questions.length, 
	                getData: function ($defer, params) {
	                    $scope.data = $rootScope.questions.slice((params.page() - 1) * params.count(), params.page() * params.count());
	                    $defer.resolve($scope.data);
	                }
	            });


				$scope.allquestionsTable = new ngTableParams({
                page: 1,
                count: 6
	            }, {
	                total: $rootScope.allquestions.length, 
	                getData: function ($defer, params) {
	                    $scope.alldata = $rootScope.allquestions.slice((params.page() - 1) * params.count(), params.page() * params.count());
	                    $defer.resolve($scope.alldata);
	                }
	            });

			}
			
		}).error(function(err){
			console.log(err);
		});
	}

	$scope.requestData();	


	//*************************************************************

	 
	//*************filter user's questions to (answerd,unanswered,all)***************
	
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

		$scope.questionsTable = new ngTableParams({
                page: 1,
                count: 6
	            }, {
	                total: $rootScope.questions.length, 
	                getData: function ($defer, params) {
	                    $scope.data = $rootScope.questions.slice((params.page() - 1) * params.count(), params.page() * params.count());
	                    $defer.resolve($scope.data);
	                }
	            });
	};

	//*************filter ALL questions to (answerd,unanswered,all)***************

	$scope.filterAllQuestions = function(status){

		$rootScope.allquestions = $rootScope.allquestionsWithoutFilter;

		questions=[];
		if(status== 'answered'){
		
			angular.forEach( $rootScope.allquestionsWithoutFilter, function(value , key){
				if(value['answer_number'] > 0){
					questions.push(value) ; 
				}
			} );
			$rootScope.allquestions = questions;

		}else if(status == 'unanswered'){

			angular.forEach( $rootScope.allquestionsWithoutFilter, function(value , key){
				if(value['answer_number'] == 0){
					questions.push(value) ; 
				}
			} );
			$rootScope.allquestions = questions;

		}else if(status == 'all'){

			$rootScope.allquestions = $rootScope.allquestionsWithoutFilter;

		}

		$scope.allquestionsTable = new ngTableParams({
                page: 1,
                count: 6
	            }, {
	                total: $rootScope.allquestions.length, 
	                getData: function ($defer, params) {
	                    $scope.alldata = $rootScope.allquestions.slice((params.page() - 1) * params.count(), params.page() * params.count());
	                    $defer.resolve($scope.alldata);
	                }
	            });
	};

	//*****************get course questions********************

	$scope.courseQuestions = function(){

		$rootScope.coursequestions = [];

		angular.forEach( $rootScope.questionsWithoutFilter, function(value , key){

				if(value['course_name'] == $scope.course_name){

					$rootScope.coursequestions.push(value);
				}
				
			} );
		$scope.coursesTable = new ngTableParams({
                page: 1,
                count: 6
	            }, {
	                total: $rootScope.coursequestions.length, 
	                getData: function ($defer, params) {
	                    $scope.coursedata = $rootScope.coursequestions.slice((params.page() - 1) * params.count(), params.page() * params.count());
	                    $defer.resolve($scope.coursedata);
	                }
	            });

	}


	if($routeParams.name){

		$scope.course_name = $routeParams.name;
		$scope.courseQuestions();
		$scope.length = $scope.coursequestions.length;

	}

})
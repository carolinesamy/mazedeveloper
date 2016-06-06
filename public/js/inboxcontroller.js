angular.module('developerMaze').controller('inboxCtl',function( socket,$scope,$location ,$http, $rootScope,sessionService){

	$scope.msg = {
		'to':'',
		'content':''
	}

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
	/*********** get all instructors ****************/

	$scope.getAllInstructors=function(){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/getallinstructors',
			data: {
				'user_id': sessionService.get('user'),
				'type':sessionService.get('type')
			}
		}).success(function(res){

			console.log(res);
			$rootScope.instructors = res;


		}).error(function(err){
			console.log(err);
		});
	}


	/*********** get inbox message ****************/

	$scope.getInboxMsg=function(){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/getinboxmsg',
			data: {
				'user_id': sessionService.get('user'),
				'type':sessionService.get('type')
			}
		}).success(function(res){

			console.log(res);


		}).error(function(err){
			console.log(err);
		});
	}

	/**************** sent inbox message *************/

	$scope.sendMsg=function(valid){
		console.log($scope.msg);
		if(valid){
			$http({
				method: 'POST',
				url: 'http://localhost:8000/sentinboxmsg',
				data: {
					'user_id': sessionService.get('user'),
					'type':sessionService.get('type'),
					'reciver_user':$scope.msg.to,
					'message':$scope.msg.content
				}
			}).success(function(res){

				console.log(res);
				$('#composeModal').modal('hide');

				$scope.msg = {
					'instructor_id':'',
					'content':''
				}


			}).error(function(err){
				console.log(err);
			});
		}
	}


});
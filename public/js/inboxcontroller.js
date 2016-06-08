angular.module('developerMaze').controller('inboxCtl',function( socket,$sce,$scope,$location ,$http, $rootScope,sessionService){

	$scope.msg = {
		'to':'',
		'content':''
	}

  $scope.peopleObj = {};
  


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
				
				$rootScope.questions = $rootScope.questions.map(function(item){
				item.content = $sce.trustAsHtml(item.content)
				return item;
				});
				$rootScope.allquestions = $rootScope.allquestions.map(function(item){
				item.content = $sce.trustAsHtml(item.content)
				return item;
				});
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

			$scope.people = res;


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
			$scope.myInboxMsgs = res;


		}).error(function(err){
			console.log(err);
		});
	}

	$scope.getInboxMsg();

	/**************** sent inbox message *************/

	$scope.sendMsg=function(valid){
		console.log('msg');
		console.log($scope.msg.to.id);
		if(valid && $scope.msg.content){
			$http({
				method: 'POST',
				url: 'http://localhost:8000/sentinboxmsg',
				data: {
					'user_id': sessionService.get('user'),
					'type':sessionService.get('type'),
					'reciver_user':$scope.msg.to.id,
					'message':$scope.msg.content
				}
			}).success(function(res){

				
					console.log(res);
					socket.emit('new_count_msg_notification');



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
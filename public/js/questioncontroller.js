angular.module('developerMaze').controller('questionCtl',function( $scope ,sessionService ,$rootScope ,$http, server,$routeParams){

	// //code mirror code
	// $scope.editorOptions = {
 //        lineWrapping : true,
 //        lineNumbers: true,
 //        mode: 'xml',
 //   		};
   	$rootScope.answers ='';
   	$rootScope.replies = '';
   	$rootScope.comments = '';
   	$rootScope.likes = '';
   	$rootScope.dislikes = '';


	$rootScope.question_id=$routeParams.id;
	


	//***************get question data function*************************

	$scope.get_question_data=function(){
		$http({
			method:'POST',
			url: 'http://localhost:8000/questiondata',
			data: {
				'id':$rootScope.question_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')
			}
		}).success(function(res){

			console.log(res);

			$rootScope.question = res.question[0];
			$rootScope.answers = res.answers;
			$rootScope.comments = res.comments;
			$rootScope.replies = res.replies;
			$rootScope.tags = res.tags;
			$rootScope.likes = res.likescount;
			$rootScope.dislikes = res.dislikecount;
			$rootScope.likesCondition = res.likes;
			

		}).error(function(err){
			console.log(err);
		});
	};
	$scope.get_question_data();

	//****************************************************************

	

	//*******************accept answer function***************

	$scope.acceptAnswer = function(answer_id,index){

		//this block of code will be in http request success function

		$http({
			method: 'POST',
			url: 'http://localhost:8000/accept',
			data: {
				//'id':1

				'id':answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')


			}
		}).success(function(res){
			console.log(res);
			$scope.answers[index]['accepted'] = 1;
			$scope.question['solved'] = 1;
		}).error(function(err){
			console.log(err);
		});

	};

	//******************* UN-accept answer function***************

	$scope.unacceptAnswer = function(answer_id,index){

		//this block of code will be in http request success function

		$http({
			method:'POST',
			url: 'http://localhost:8000/unaccept',
			data: {
				//'id':1
				'id':answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')


			}
		}).success(function(res){
			console.log(res);
			$scope.answers[index]['accepted'] = 0;
			$scope.question['solved'] = 0;
		}).error(function(err){
			console.log(err);
		});

	};

	//*******************Add answer function***************

	$scope.addAnswer=function(valid){

		if($scope.image_path){
			image = $scope.image_path.name;
		}else{image=''}

		if(valid) {
			if (sessionService.get('type') == 'student') {
				arr = {
					'content': $scope.answer_content,
					'image': image,
					'question_id': $rootScope.question_id,
					'id': sessionService.get('user'),
					'type': 'student'
				};
			}
			else {
				arr = {
					'content': $scope.answer_content,
					'image':image,
					'question_id': $rootScope.question_id,
					'id': sessionService.get('user'),
					'type': 'instructor'
				};
			}
			//console.log(arr);
			$http({
				method: 'POST',
				url: 'http://localhost:8000/addanswer',
				data: {
					answer: arr
				}
			}).success(function (res) {
				console.log(res);
				$rootScope.answers.push(res);
				$rootScope.replies[$rootScope.answers.length-1] =[];
				$scope.answer_content='';

			}).error(function (err) {
				console.log(err);
			});
		}
		
	};

	//*******************Edit answer function***************

	$scope.editAnswer=function(answer_id){
		//console.log($scope.image_path);

			if (sessionService.get('type') == 'student') {
				arr = {
					'content': $scope.answer_content,
					'image': $scope.image_path.name,
					'question_id': $rootScope.question_id,
					'answer_id':answer_id,
					'id': sessionService.get('user'),
					'type': 'student'
				};
			}
			else {
				arr = {
					'content': $scope.answer_content,
					'image': $scope.image_path.name,
					'question_id': $rootScope.question_id,
					'id': sessionService.get('user'),
					'type': 'instructor'
				};
			}
			console.log(arr);
			//$http({
			//	method: 'POST',
			//	url: 'http://localhost:8000/editanswer',
			//	data: {
			//		answer: arr
			//	}
			//}).success(function (res) {
			//	console.log(res);
			//}).error(function (err) {
			//	console.log(err);
			//});

	};

	//*******************add Comment function***************

	$scope.addComment=function(){

		if (sessionService.get('type') == 'student') {
			arr = {
				'content': $scope.comment,
				'question_id': $rootScope.question_id,
				'user_id': sessionService.get('user'),
				'type': 'student'
			};
		}
		else {
			arr = {
				'content': $scope.comment,
				'question_id': $rootScope.question_id,
				'user_id': sessionService.get('user'),
				'type': 'instructor'
			};
		}
		//console.log(arr);
		$http({
			method: 'POST',
			url: 'http://localhost:8000/questioncomment',
			data: {
				comment: arr
			}
		}).success(function (res) {
			console.log(res);
			$rootScope.comments.push(res);
			$scope.comment = '';
			

		}).error(function (err) {
			console.log(err);
		});

	};

	//*******************Edit Question function***************

	$scope.editQuestion = function(valid){
		console.log($scope.selected_tags);
		if(valid){
			$http({
				method: 'POST',
				url: 'http://localhost:8000/editquestion',
				data: {
					'title':$scope.question.title,
					'content':$scope.question.content,
					'image':'',
					//'course_id':$scope.question.course,
					//'tag_id':$scope.question.tag,
					'course_id':1,
					'tag_id':[2,1],
					'student_id':sessionService.get('user')
				}
			}).success(function(res){
				$('#askModal').modal('hide');
				console.log(res);

			}).error(function(err){
				console.log(err);
			});
			$scope.question = {
				'title':'',
				'content':'',
				'image':'',
				'student_id':''
			};
		}
	};

	//*******************Add Reply function***************

	$scope.addReply=function(answer_id,reply,index){
		
		$http({
			method: 'POST',
			url: 'http://localhost:8000/answerreply',
			data: {
				'reply': {
					'content': reply,
					'answer_id': answer_id,
					'user_id': sessionService.get('user'),
					'type': sessionService.get('type')
				}
			}
		}).success(function(res){

			console.log('answer_id:'+answer_id+" reply:"+reply+" index:"+index);
			$rootScope.replies[index].push(res);


		}).error(function(err){
			console.log(err);
		});
	};

	//*******************Like function***************

	$scope.like=function(answer_id){
		// data={
		// 	'answer_id': answer_id,
		// 		'user_id': sessionService.get('user'),
		// 		'type': sessionService.get('type')
		// };
		// console.log(data);
		$http({
			method: 'POST',
			url: 'http://localhost:8000/likeaction',
			data: {
					'answer_id': answer_id,
					'user_id': sessionService.get('user'),
					'type': sessionService.get('type')
			}
		}).success(function(res){
			console.log(res);
        
		}).error(function(err){
			console.log(err);
		});
	};

	//*******************Dislike function***************

	$scope.dislike=function(answer_id){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/dislikeaction',
			data: {
				'answer_id': answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')
			}
		}).success(function(res){
			console.log(res);

		}).error(function(err){
			console.log(err);
		});
	};

	$scope.removeLike=function(answer_id){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/removelike',
			data: {
				'answer_id': answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')
			}
		}).success(function(res){
			console.log(res);

		}).error(function(err){
			console.log(err);
		});
	};

	//*******************Remove Dislike function***************

	$scope.removeDislike=function(answer_id){

		$http({
			method: 'POST',
			url: 'http://localhost:8000/removedislike',
			data: {
				'answer_id': answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')
			}
		}).success(function(res){
			console.log(res);

		}).error(function(err){
			console.log(err);
		});
	};



});




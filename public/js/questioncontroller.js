angular.module('developerMaze').controller('questionCtl',function( socket,$scope ,sessionService ,$rootScope ,$http, server,$routeParams){

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
			$rootScope.likesCondition = res.likes; // likes object
			$rootScope.user_type=sessionService.get('type');// user type
			console.log('nums');
			//console.log($rootScope.likesnums);
			console.log($rootScope.likes);

			var check=0;
			$rootScope.ui_likes=[];
			console.log('likes');
			angular.forEach($rootScope.likesCondition,function(condition){
				//$rootScope.in_likes=[];
				//console.log(condition);
				for (var i=0;i<condition.length;i++){
					if(condition[i].user_id==$rootScope.currentuser&&condition[i].user_type==$rootScope.user_type){
						$rootScope.ui_likes.push([{
							'empty':0,
							'like':condition[i].like,
							'me':1
						}]);
						//console.log('entered condition');
						check=1;
					}

				}
				if(check==0){
					$rootScope.ui_likes.push([{
						'empty':1
					}]);
				}
				else {
					check=0;
				}
				//$rootScope.ui_likes.push($rootScope.in_likes);
			});

			console.log($rootScope.ui_likes);
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

				//*** socket notification
				$http({
					method: 'POST',
					url: 'http://localhost:8000/answernotification',
					data: {
						'student_id': sessionService.get('user'),
						'user_type': sessionService.get('type'),
						'question_id':$rootScope.question_id,
						'notification_type':'answer'
					}
				}).success(function(res){


					socket.emit('new_count_notification');

				})

			}).error(function (err) {
				console.log(err);
			});
		}
		
	};

	//*******************Edit answer function***************

	$scope.editAnswer=function(valid){
		
		if(valid){
			if (sessionService.get('type') == 'student') {

				arr = {
					'content': $scope.editanswer_content,
					'image': '',
					'answer_id':$scope.editanswer_id,
					'id': sessionService.get('user'),
					'type': 'student'
				};
			}
			else {
				arr = {
					'content': $scope.editanswer_content,
					'image': '',
					'answer_id':answer_id,
					'id': sessionService.get('user'),
					'type': 'instructor'
				};
			}
			console.log(arr);
			$http({
				method: 'POST',
				url: 'http://localhost:8000/editanswer',
				data: {
					answer: arr
				}
			}).success(function (res) {
				console.log(res);
                $('#editAnswerModal').modal('hide');              
                $rootScope.answers[$scope.answer_index].answer_content = $scope.editanswer_content;

			}).error(function (err) {
				console.log(err);
			});
		}
	};

	$scope.editAnswerData = function(answer,index){
		console.log(index);
		$scope.editanswer_content = answer.answer_content;
		$scope.editanswer_id = answer.answer_id;
		$scope.answer_index = index;

	}

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
		if($scope.comment){
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

				$http({
					method: 'POST',
					url: 'http://localhost:8000/commentnotification',
					data: {
						'student_id': sessionService.get('user'),
						'user_type': sessionService.get('type'),
						'question_id':$rootScope.question_id,
						'notification_type':'comment'
					}
				}).success(function(res){

					console.log(res);

					socket.emit('new_count_notification');

				})

			}).error(function (err) {
				console.log(err);
			});
		}
		

	};

	//*******************Edit Question function***************

	$scope.editQuestion = function(valid){
		console.log($scope.question.edittags);
		if(valid){
			$http({
				method: 'POST',
				url: 'http://localhost:8000/editquestion',
				data: {
					'title':$scope.question.edittitle,
					'content':$scope.question.editcontent,
					'image':'',
					//'course_id':1,
					'question_id': $rootScope.question_id,
					'tag_id':$scope.question.edittags,
					'student_id':sessionService.get('user'),
					'type':sessionService.get('type')
				}
			}).success(function(res){
                $('#editQuestionModal').modal('hide');
				console.log('tags:'+res);

				$rootScope.question.question_content = $scope.question.editcontent;
				$rootScope.question.question_title = $scope.question.edittitle;
				$rootScope.tags = res;


			}).error(function(err){
				console.log(err);
			});
		
		}
	};

	$scope.editQuestionData = function(){

		$http({
            method: 'POST',
            url: 'http://localhost:8000/gettags',
           data:{
               'id':sessionService.get('user'),
               'type':sessionService.get('type')
           }
        }).success(function(res){

            $scope.edittags= res.tags_id;//all tags
            $scope.question.edittitle = $rootScope.question.question_title;
            $scope.question.editcontent = $rootScope.question.question_content;
            $scope.question.edittags = $rootScope.tags;//selected tags
			$scope.question.unselectedTags=[];
			//$scope.selectedTags=[];
			$scope.unselectedTags=[];
			var flag=0;
			var keepGoing=1;
			angular.forEach($scope.edittags, function(value, key){
				flag=0;
				angular.forEach($scope.question.edittags,function(valuee,keyy){
					if(value.id==valuee.id){
						flag++;
					}
				});

				if(flag==0){$scope.question.unselectedTags.push(value);}
			});
			console.log("selected tags: ");
			console.log($scope.question.edittags);
			console.log("unselected tags: ");
			console.log($scope.question.unselectedTags);

            console.log($scope.question.edittags);



        }).error(function(err){
            console.log(err);
        });

	}

	//*******************Add Reply function***************

	$scope.addReply=function(answer_id,reply,index){
		if(reply){
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

				$http({
					method: 'POST',
					url: 'http://localhost:8000/replynotification',
					data: {
						'student_id': sessionService.get('user'),
						'user_type': sessionService.get('type'),
						'question_id':$rootScope.question_id,
						'answer_id':answer_id,
						'notification_type':'reply'
					}
				}).success(function(res){

					console.log(res);

					socket.emit('new_count_notification');

				})


			}).error(function(err){
				console.log(err);
			});
		}
		
	};

	//*******************Like function***************

	$scope.like=function(answer_id){
		// data={
		// 	'answer_id': answer_id,
		// 		'user_id': sessionService.get('user'),
		// 		'type': sessionService.get('type')
		// };
		// console.log(data);
		console.log('entered Like');
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
			console.log('end Like');

			$http({
				method: 'POST',
				url: 'http://localhost:8000/likenotification',
				data: {
					'student_id': sessionService.get('user'),
					'user_type': sessionService.get('type'),
					'answer_id': answer_id,
					'notification_type':'like'
				}
			}).success(function(res){

				console.log(res);

				socket.emit('new_count_notification');

			})
        
		}).error(function(err){
			console.log(err);
		});
	};

	//*******************Dislike function***************

	$scope.dislike=function(answer_id){
		console.log('entered disLike');
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

			$http({
				method: 'POST',
				url: 'http://localhost:8000/dislikenotification',
				data: {
					'student_id': sessionService.get('user'),
					'user_type': sessionService.get('type'),
					'answer_id': answer_id,
					'notification_type':'dislike'
				}
			}).success(function(res){

				console.log(res);

				socket.emit('new_count_notification');

			})

		}).error(function(err){
			console.log(err);
		});
	};

	$scope.removeLike=function(answer_id){
		console.log('entered removeLike');
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
		console.log('entered removedisLike');
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

	//****************golden star*************************

	$scope.goldenStar = function(answer_id){
		
		console.log('golden function');
		//data={
		//	'answer_id': answer_id,
		//	'user_id': sessionService.get('user'),
		//	'type': sessionService.get('type')
		//};
		//console.log(data);
		$http({
			method: 'POST',
			url: 'http://localhost:8000/goldenmark',
			data: {
				'answer_id': answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')
			}
		}).success(function(res){
			console.log(res);
			console.log('end Like');

		}).error(function(err){
			console.log(err);
		});
	}

});



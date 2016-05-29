angular.module('developerMaze').controller('questionCtl',function( $scope ,sessionService ,$rootScope ,$http, server,$routeParams){

	

	 console.log($routeParams.id);
	$rootScope.question_id=$routeParams.id;

	/*** get question data **/

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
			$rootScope.answers=res.answer;
		}).error(function(err){
			console.log(err);
		});
	}
	$scope.get_question_data();


	//logged-in user
	// $scope.user = {
 //      email: '',
 //      password: '',
 //      notifications :0
 //    };

    $scope.editorOptions = {
        lineWrapping : true,
        lineNumbers: true,
        mode: 'xml',
    };

	// //details of this question 
	// $scope.question = 
	// 	{
	// 	'id':1,
	// 	'title':"HTML tags doesn't work",
	// 	'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
	// 	'answers':20,
	// 	'solved':0
	// 	};
	// //questions' answers
	// $scope.answers = [
	// 	{
	// 	'id':1,
	// 	'content':"malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
	// 	'time':'11/01/2016 17:40:66',
	// 	'image':'',
	// 	'like': 5,
	// 	'dislike': 1,
	// 	'accepted':0,
	// 	'user_name':'Aya',
	// 	'user_image':''
	// 	},
	// 	{
	// 	'id':2,
	// 	'content':"senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
	// 	'time':'07/04/2016 03:13:04',
	// 	'image':'',
	// 	'like': 12,
	// 	'dislike': 3,
	// 	'accepted':0,
	// 	'user_name':'Merna',
	// 	'user_image':''
	// 	}
	// ];

	// $scope.replies = [
	// 	{
	// 	'id':1,
	// 	'content':"senectus et netus et malesuada fames ac turpis egestas.",
	// 	'time':'07/04/2016 03:13:04',
	// 	'user_name':'christina',
	// 	},
	// 	{
	// 	'id':2,
	// 	'content':"ames ac turpis egestas. Vestibulum ",
	// 	'time':'07/04/2016 03:13:04',
	// 	'user_name':'caroline',
	// 	}
	// ];

	// $scope.comments = [
	// 	{
	// 	'id':1,
	// 	'content':"senectus et netus et malesuada fames ac turpis egestas.",
	// 	'time':'07/04/2016 03:13:04',
	// 	'user_name':'christina',
	// 	},
	// 	{
	// 	'id':2,
	// 	'content':"ames ac turpis egestas. Vestibulum ",
	// 	'time':'07/04/2016 03:13:04',
	// 	'user_name':'caroline',
	// 	}
	// ];

	$scope.acceptAnswer = function(answer_id,index){

		//this block of code will be in http request success function

		$http({
			method: 'POST',
			url: 'http://localhost:8000/accept',
			data: {
				'id':1
				//'id':answer_id

			}
		}).success(function(res){
			console.log(res);
			$scope.answers[index]['accepted'] = 1;
			$scope.question['solved'] = 1;
		}).error(function(err){
			console.log(err);
		});

	};

	$scope.unacceptAnswer = function(answer_id,index){

		//this block of code will be in http request success function

		$http({
			method:'POST',
			url: 'http://localhost:8000/unaccept',
			data: {
				'id':1
				//'id':answer_id
			}
		}).success(function(res){
			console.log(res);
			$scope.answers[index]['accepted'] = 0;
			$scope.question['solved'] = 0;
		}).error(function(err){
			console.log(err);
		});

	};


	$scope.addAnswer=function(valid){
		console.log($scope.image_path);

		if(valid) {
			if (sessionService.get('type') == 'student') {
				arr = {
					'content': $scope.answer_content,
					'image': $scope.image_path,
					'question_id': $rootScope.question_id,
					'id': sessionService.get('user'),
					'type': 'student'
				};
			}
			else {
				arr = {
					'content': $scope.answer_content,
					'image': $scope.image_path,
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
			}).error(function (err) {
				console.log(err);
			});
		}
		
	};

	$scope.editAnswer=function(answer_id){
		//console.log($scope.image_path);

			if (sessionService.get('type') == 'student') {
				arr = {
					'content': $scope.answer_content,
					'image': $scope.image_path,
					'question_id': $rootScope.question_id,
					'answer_id':answer_id,
					'id': sessionService.get('user'),
					'type': 'student'
				};
			}
			else {
				arr = {
					'content': $scope.answer_content,
					'image': $scope.image_path,
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
		console.log(arr);
		//$http({
		//	method: 'POST',
		//	url: 'http://localhost:8000/questioncomment',
		//	data: {
		//		comment: arr
		//	}
		//}).success(function (res) {
		//	console.log(res);
		//}).error(function (err) {
		//	console.log(err);
		//});

	};

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

	$scope.addReply=function(answer_id,reply){
		data={
			'content': reply,
			'answer_id': answer_id,
			'user_id': sessionService.get('user'),
			'type': sessionService.get('type')
		};
		console.log(data);
		//$http({
		//	method: 'POST',
		//	url: 'http://localhost:8000/answerreply',
		//	data: {
		//		'reply': {
		//			'content': reply,
		//			'answer_id': answer_id,
		//			'user_id': sessionService.get('user'),
		//			'type': sessionService.get('type')
		//		}
		//	}
		//}).success(function(res){
		//	console.log(res);
        //
		//}).error(function(err){
		//	console.log(err);
		//});
	};


	$scope.like=function(answer_id){
		data={
			'answer_id': answer_id,
				'user_id': sessionService.get('user'),
				'type': sessionService.get('type')
		};
		console.log(data);
		//$http({
		//	method: 'POST',
		//	url: 'http://localhost:8000/likeaction',
		//	data: {
		//			'answer_id': answer_id,
		//			'user_id': sessionService.get('user'),
		//			'type': sessionService.get('type')
		//	}
		//}).success(function(res){
		//	console.log(res);
        //
		//}).error(function(err){
		//	console.log(err);
		//});
	};

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



});




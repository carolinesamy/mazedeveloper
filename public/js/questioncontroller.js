angular.module('developerMaze').controller('questionCtl',function( $scope ,$rootScope ,$http, server,$routeParams){

	
	 console.log($routeParams.id);
	//logged-in user
	$scope.user = {
      email: '',
      password: '',
      notifications :0
    };

    $scope.editorOptions = {
        lineWrapping : true,
        lineNumbers: true,
        mode: 'xml',
    };

	//details of this question 
	$scope.question = 
		{
		'id':1,
		'title':"HTML tags doesn't work",
		'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
		'answers':20,
		'solved':0
		};
	//questions' answers
	$scope.answers = [
		{
		'id':1,
		'content':"malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
		'time':'11/01/2016 17:40:66',
		'image':'',
		'like': 5,
		'dislike': 1,
		'accepted':0,
		'user_name':'Aya',
		'user_image':''
		},
		{
		'id':2,
		'content':"senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
		'time':'07/04/2016 03:13:04',
		'image':'',
		'like': 12,
		'dislike': 3,
		'accepted':0,
		'user_name':'Merna',
		'user_image':''
		}
	];

	$scope.replies = [
		{
		'id':1,
		'content':"senectus et netus et malesuada fames ac turpis egestas.",
		'time':'07/04/2016 03:13:04',
		'user_name':'christina',
		},
		{
		'id':2,
		'content':"ames ac turpis egestas. Vestibulum ",
		'time':'07/04/2016 03:13:04',
		'user_name':'caroline',
		}
	];

	$scope.comments = [
		{
		'id':1,
		'content':"senectus et netus et malesuada fames ac turpis egestas.",
		'time':'07/04/2016 03:13:04',
		'user_name':'christina',
		},
		{
		'id':2,
		'content':"ames ac turpis egestas. Vestibulum ",
		'time':'07/04/2016 03:13:04',
		'user_name':'caroline',
		}
	];

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

	}




})




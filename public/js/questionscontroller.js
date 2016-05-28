
angular.module('developerMaze').controller('questionsCtl',function( $scope ,$http, sessionService,$location, $rootScope , server){


	//logged-in user
	$scope.user = {
      email: '',
      password: '',
      notifications :0
    };

	//user's courses
	$scope.courses =[
	{
		course_name:'PHP',
	 	course_id:1
	},
	{
		course_name:'Laravel',
	 	course_id:2
	},
	{
		course_name:'AngularJS',
	 	course_id:4
	},
	{
		course_name:'Bootstrap',
	 	course_id:5
	},
	];
	//recent questions in his courses
	$scope.questions = [
		{
		'id':1,
		'title':"HTML tags doesn't work",
		'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
		'answers':20
		},
		{
		'id':2,
		'title':"how to install Laravel in ubuntu??",
		'answers':7,
		'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas."
		},
		{
		'id':3,
		'title':"i can't upload image using PHP",
		'answers':3,
		'content':"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas."
		}
	];

	$scope.requestData=function(){
		//console.log('hello from controller');
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
		}).error(function(err){
			console.log(err);
		});
	}
	$scope.requestAsk=function(){
		$http({
			method: 'GET',
			url: 'http://localhost:8000/gettags',
		}).success(function(res){
			console.log(res);
			$scope.tags=res;
		}).error(function(err){
			console.log(err);
		});
	}
	$scope.requestData();

	// $scope.moreDetails = function(question_id){
	// 	console.log(question_id);
	// 	$location('/question');
	// }


})
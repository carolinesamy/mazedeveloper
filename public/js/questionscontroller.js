angular.module('developerMaze').controller('questionsCtl',function( $scope , server){

	$scope.user = {
		notifications :0
	};

	
	$scope.courses =['PHP','Laravel','AngularJS','Bootstrap','Django','Rails','mySQL'];
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
	]
})
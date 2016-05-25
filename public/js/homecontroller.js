angular.module('developerMaze').controller('homeCtl',function( $scope , server , $rootScope,$http){


	// server.connect('tracks','GET').success(function(data){
	// 	console.log(data);
	// }).error(function(data){
	// 	console.log(data);
	// });
  
	//logged-in user
	$scope.user = {
      email: '',
      password: '',
      notifications :0
    };

    $scope.sendData = function(loginForm) {
        // $scope.token= CSRF_TOKEN;
        // console.log({{ csrf_token() }});
        $http({
            method: 'POST',
            url: 'http://localhost:8000/post_to_me',
            data: {
                'user':$scope.user ,
               
            }
        }).success(function(res){
            console.log(res);
        }).error(function(err){
            console.log(err);
        })
    };
    



})


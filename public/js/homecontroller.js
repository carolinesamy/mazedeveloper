angular.module('developerMaze').controller('homeCtl',function( $scope , server , $rootScope){


	// server.connect('tracks','GET').success(function(data){
	// 	console.log(data);
	// }).error(function(data){
	// 	console.log(data);
	// });
  

	$scope.user = {
      email: '',
      password: '',
      notifications :0
    };


    



})


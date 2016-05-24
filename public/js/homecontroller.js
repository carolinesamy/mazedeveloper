angular.module('developerMaze').controller('homeCtl',function( $scope , server){


	// server.connect('tracks','GET').success(function(data){
	// 	console.log(data);
	// }).error(function(data){
	// 	console.log(data);
	// });
	$scope.user = {
      email: '',
      password: ''
    };

    $scope.submitLogin = function(){

    	console.log($scope.user.email);
    	console.log($scope.user.password);
    };

    // $scope.sliderImage = 'images/img4.jpg';



})


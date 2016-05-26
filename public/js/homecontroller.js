'use strict';
angular.module('developerMaze').controller('homeCtl',function( $scope , $rootScope,$http,$location,sessionService){
	//logged-in user
	$scope.user = {
      email: '',
      password: '',
      notifications :0
    };

});


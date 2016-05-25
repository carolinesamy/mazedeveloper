angular.module('developerMaze').controller('headerCtl',function( $scope , server , $rootScope){


    $scope.submitLogin = function(){

      $rootScope.currentuser = $scope.user;
      $('#myModal').modal('hide');
    	// console.log($scope.user.email);
    	// console.log($scope.user.password);
    };

    $scope.logout = function(){

      $rootScope.currentuser = null;
      $('#logoutModal').modal('hide');
    };




})


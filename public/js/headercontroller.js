angular.module('developerMaze').controller('headerCtl',function( $scope ,$http, server , $rootScope){

    console.log($rootScope.currentuser);

    $scope.sendData = function(valid){
      if(valid){

        $http({
            method: 'POST',
            url: 'http://localhost:8000/login',
            data: {
                'user':$scope.user ,
               
            }
        }).success(function(res){

            $rootScope.currentuser = res;
            $('#myModal').modal('hide');
            console.log($rootScope.currentuser+" logged in");

        }).error(function(err){
            console.log(err);
        });
      }
      
 	
    };

    $scope.logout = function(){

      $rootScope.currentuser = null;
      $('#logoutModal').modal('hide');
    };




})


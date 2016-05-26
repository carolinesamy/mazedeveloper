angular.module('developerMaze').controller('courseCtl',function( $scope ,$http, $rootScope){

    console.log($rootScope.currentuser);
    $scope.state = false;
    
    $scope.toggleState = function() {
        $scope.state = !$scope.state;
    };

    


})


angular.module('developerMaze').controller('headerCtl',function( $scope,$location ,$http, $rootScope,$location){

    console.log($rootScope.currentuser);
    $scope.question = {
      'title':'',
      'content':''
    }

    $scope.notifications = [
      {
        'id':1,
        'user':'aya',
        'content':'answered your question'
      },
      {
        'id':2,
        'user':'caroline',
        'content':'replied to your answer'
      },
      {
        'id':4,
        'user':'merna',
        'content':'accept your answer'
      },
    ];

    $scope.courses = ['PHP','Bootstrap','Django','Java'];

    $scope.user.notification = $scope.notifications.length;

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
            $location.url('/questions');
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


    $scope.askQuestion = function(){

      console.log($scope.question.title);
      $('#askModal').modal('hide');
      $scope.question = {
      'title':'',
      'content':''
    }

    }



})


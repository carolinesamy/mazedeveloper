'use strict';

angular.module('developerMaze').controller('headerCtl',function( $scope,$location ,$http, $rootScope,sessionService){

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

    $scope.user.notification = $scope.notifications.length;

    $scope.sendData = function(valid){
      if(valid){

        $http({
            method: 'POST',
            url: 'http://localhost:8000/login',
            data: {
                'user':$scope.user
               
            }
        }).success(function(res){
            sessionService.set('user',res.id);
            $rootScope.currentuser = res;
            $('#myModal').modal('hide');
            $location.url('/questions');

        }).error(function(err){
            console.log(err);
            $location.path('/');
        });
      }
    };

    $scope.logout = function(){
        sessionService.destroy('user');

        $rootScope.currentuser = null;
        $('#logoutModal').modal('hide');
        $location.path('/');

    };


    $scope.askQuestion = function(){

      console.log($scope.question.content);
      $('#askModal').modal('hide');
      $scope.question = {
      'title':'',
      'content':''
    }

    }



})


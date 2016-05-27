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

    $scope.courses = ['PHP','Bootstrap','Django','Java'];

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

            console.log(res.user['id']);
            sessionService.set('user',res.user['id']);
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

        //
        //console.log($scope.question.title);
        //    console.log($scope.question.content);
        //   console.log(sessionService.get('user'));

       console.log($scope.question.content);
      $('#askModal').modal('hide');
        $http({
            method: 'POST',
            url: 'http://localhost:8000/ask',
            data: {
                'title':$scope.question.title,
                'content':$scope.question.content,
                'image':'',
                //'course_id':$scope.question.course,
                //'tag_id':$scope.question.tag,
                'course_id':1,


                'tag_id':[2,1],
                'student_id':sessionService.get('user')
            }
        }).success(function(res){
            $('#myModal').modal('hide');
            console.log(res);

        }).error(function(err){
            console.log(err);
        });
      $scope.question = {
            'title':'',
            'content':'',
            'image':'',
            'student_id':''
        };

    };



})


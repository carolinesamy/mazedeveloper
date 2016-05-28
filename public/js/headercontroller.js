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

            if(res.message=='password'){
                console.log('pssword invalid');
                $location.path('/');
            }
            else if (res.message=='email'){
                console.log('email invalid');
                $location.path('/');
            }
            else if(res.message=='login') {
                console.log(res.user['id']);
                sessionService.set('user', res.user['id']);
                sessionService.set('type',res.type);
                $rootScope.currentuser = res;
                $('#myModal').modal('hide');
                $location.url('/questions');
            }
        }).error(function(err){
            console.log(err);
            $location.path('/');
        });
      }
    };

    $scope.logout = function(){
        sessionService.destroy('user');
        sessionService.destroy('type');
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
            $('#askModal').modal('hide');
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

    $scope.autoComplete=function(){
        $http({
            method: 'POST',
            url: 'http://localhost:8000/complete',
            data: {
                'sentance':$scope.question.title
            }
        }).success(function(res){
            console.log(res);
        }).error(function(err){
            console.log(err);
        });
    };



});


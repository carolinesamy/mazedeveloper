'use strict';

angular.module('developerMaze').controller('headerCtl',function( $scope,$location ,$http, $rootScope,sessionService){


    $scope.question = {
      'title':'',
      'content':'',
      'course':'',
      'tags':''
    }
    $scope.titleError ='';
    $rootScope.user_id = sessionService.get('user');
    $rootScope.user_type = sessionService.get('type');
   
    
//****************************login function*********************************

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
                alert('Invalid Password..');
                $location.path('/');
            }
            else if (res.message=='email'){
                alert('Invalid Email..');
                $location.path('/');
            }
            else if(res.message=='login') {
                //console.log(res.user);

                sessionService.set('user', res.user['id']);
                sessionService.set('type',res.type);

                $rootScope.currentuser ={
                    'name': res.user['sfull_name'],
                    'id': res.user['id']
                }

                $('#myModal').modal('hide');
                $location.url('/questions');
            }
        }).error(function(err){
            console.log(err);
            $location.path('/');
        });
      }
    };

    //**************************logout function********************

    $scope.logout = function(){

        sessionService.destroy('user');
        sessionService.destroy('type');
        $rootScope = null;
        $('#logoutModal').modal('hide');
        $location.path('/');

    };

    //**************************Ask Question function********************

    $scope.askQuestion = function(valid){
        
        if(valid){
            $http({
                method: 'POST',
                url: 'http://localhost:8000/ask',
                data: {
                    'title':$scope.question.title,
                    'content':$scope.question.content,
                    'image':'',
                    'course_id':$scope.question.course,
                    'tag_id':$scope.question.tags,
                    'student_id':sessionService.get('user'),
                    'type': sessionService.get('type')
                }
            }).success(function(res){
                $('#askModal').modal('hide');
                $rootScope.allquestions.splice(0, 0, res);
                $rootScope.questions.splice(0, 0, res);

                console.log(res);
                $scope.question = '';
                $scope.titleError ='';

            }).error(function(err){
                console.log(err);
            });
         
        }
    };

    //**************************get Tags and Courses for Ask modal********************

    $scope.requestAsk=function(valid){

        if($scope.question.title){
            $http({
            method: 'POST',
            url: 'http://localhost:8000/gettags',
           data:{
               'id':sessionService.get('user'),
               'type':sessionService.get('type')
           }
        }).success(function(res){

            console.log(res.tags_id);
            $scope.tags= res.tags_id;
            $rootScope.courses = JSON.parse(res.course_data);
            $scope.titleError ='';


        }).error(function(err){
            console.log(err);
        });
        
        }else{

             $scope.titleError = "Please,Enter Title to Your Question.."

        }
        
    }

    //************************** Search function********************

    $scope.autoComplete=function(title){
        console.log($scope.question.title);
        $http({
            method: 'POST',
            url: 'http://localhost:8000/complete',
            data: {
                'sentance':title
            }
        }).success(function(res){
            console.log(res);
        }).error(function(err){
            console.log(err);
        });
    };

    //**************************get number of notification AUTO********************

    $scope.getNOtifications=function(){
        $http({
            method: 'POST',
            url: 'http://localhost:8000/getnotifications',
            data: {
                'id':sessionService.get('user'),
                'type':sessionService.get('type')
            }
        }).success(function(res){
             //console.log(res);
            $rootScope.numOfnotification = res[0].count;

        }).error(function(err){
            console.log(err);
        });
    };
    
    $scope.getNOtifications();

    //************************** get notification list ****************************
    $scope.getNotificationList=function(){
        $http({
            method: 'POST',
            url: 'http://localhost:8000/getnotificationsdata',
            data: {
                'id':sessionService.get('user'),
                'type':sessionService.get('type')
            }
        }).success(function(res){
            console.log(res);

        }).error(function(err){
            console.log(err);
        });
    };

});




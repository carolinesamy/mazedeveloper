'use strict';

angular.module('developerMaze').controller('headerCtl',function( socket,$scope,$location ,$http, $rootScope,sessionService){

    $scope.isCollapsed = true;

    $scope.question = {
      'title':'',
      'content':'',
      'course':'',
      'tags':''
    }

    $scope.status = {
    isopen: false
  };

    socket.on( 'new_count_notification', function() {
        $scope.getNOtifications();

    });

$rootScope.questionTags={selectedTags:[]};
// $scope.tagTransform = function (newTag) {
//     var item = {
//         tag_name: newTag,
        
//     };
//     return item;
//   };


  $scope.toggleDropdown = function($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isopen = !$scope.status.isopen;
  };

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
                console.log(res.user['image']);

                sessionService.set('user', res.user['id']);
                sessionService.set('type',res.type);

                $rootScope.currentuser ={
                    'name': res.user['sfull_name'],
                    'id': res.user['id']
                }
                $rootScope.user_image=res.user['image'];

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
        
        if(valid ){
            var tagsIdsArray=[];
            angular.forEach( $scope.questionTags.selectedTags,function(value,key){
                           tagsIdsArray.push(value.id);
                       });

            $http({
                method: 'POST',
                url: 'http://localhost:8000/ask',
                data: {
                    'title':$scope.question.title,
                    'content':$scope.question.content,
                    'image':'',
                    'course_id':$scope.question.course,
                    'tag_id':tagsIdsArray,
                    'student_id':sessionService.get('user'),
                    'type': sessionService.get('type')
                }
            }).success(function(res){


                //*********  socket **/
                console.log($scope.question.course);
                $http({
                    method: 'POST',
                    url: 'http://localhost:8000/questionnotification',
                    data: {
                        'student_id': sessionService.get('user'),
                        'user_type': sessionService.get('type'),
                        'course_id': $scope.question.course,
                        'notification_type':'question'
                    }
                }).success(function(res){


                    socket.emit('new_count_notification');

                })
                // ****
                $('#askModal').modal('hide');

                console.log(res);
                $rootScope.allquestions.splice(0, 0, res);
                $rootScope.questions.splice(0, 0, res);

                $scope.question= '';
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

            console.log(res);
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

        if($scope.question.title){
            $scope.status = {
                isopen: true
              };
            $http({
            method: 'POST',
            url: 'http://localhost:8000/complete',
            data: {
                'sentance':title
            }
            }).success(function(res){
                console.log(res);
                $scope.searchItems = res;
                
            }).error(function(err){
                console.log(err);
            });
        }else{
            $scope.searchItems = '';

        }
        
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
            $rootScope.notifications = res;

        }).error(function(err){
            console.log(err);
        });
    };

});




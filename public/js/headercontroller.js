'use strict';

angular.module('developerMaze').controller('headerCtl',function( socket,$scope,$location ,$sce,$http, $rootScope,sessionService){

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
    socket.on( 'new_count_msg_notification', function() {
        $scope.getMsgNOtifications();

    });

$rootScope.questionTags={selectedTags:[]};

  $scope.toggleDropdown = function($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isopen = !$scope.status.isopen;
  };

    
    $rootScope.user_id = sessionService.get('user');
    $rootScope.user_type = sessionService.get('type');
    $rootScope.user_name = sessionService.get('name');

   
    
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
                //console.log(res.user['image']);
                console.log(res);
                sessionService.set('user', res.user['id']);
                sessionService.set('type',res.type);
                if(res.type=='instructor')
                {sessionService.set('name',res.user['ifull_name']);}
                else {
                    sessionService.set('name',res.user['sfull_name']);
                }

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
        

        $http({
            method: 'POST',
            url: 'http://localhost:8000/logout',
            data: {
                'student_id': sessionService.get('user'),
                'user_type': sessionService.get('type'),
                'user_name': sessionService.get('name'),
            }
        }).success(function(res){
            console.log(res);
            sessionService.destroy('user');
            sessionService.destroy('type');
            sessionService.destroy('name');
            $rootScope = null;
            $('#logoutModal').modal('hide');
            $location.path('/');
            window.location.reload();
        }).error(function(err){
            console.log(err);
        });
    };

    //**************************Ask Question function********************

    $scope.askQuestion = function(valid){
        
        if(valid && $scope.question.content){
            var tagsIdsArray=[];
            angular.forEach( $scope.questionTags.selectedTags,function(value,key){
                           tagsIdsArray.push(value.id);
                       });

            $http({
                method: 'POST',
                url: 'http://localhost:8000/ask',
                data: {
                    'title':$scope.question.titlee,
                    'content':$scope.question.content,
                    'image':'',
                    'course_id':$scope.question.course,
                    'tag_id':tagsIdsArray,
                    'student_id':sessionService.get('user'),
                    'type': sessionService.get('type')
                }
            }).success(function(res){


                //*********  socket **/
                //console.log(res.id);
                $http({
                    method: 'POST',
                    url: 'http://localhost:8000/questionnotification',
                    data: {
                        'student_id': sessionService.get('user'),
                        'user_type': sessionService.get('type'),
                        'user_name': sessionService.get('name'),
                        'course_id': $scope.question.course,
                        'notification_type':'question',
                        'question_title':$scope.question.title,
                        'question_id':res.id,
                    }
                }).success(function(res){

                    console.log(res);
                    socket.emit('new_count_notification');

                })
                // ****
                $('#askModal').modal('hide');

                console.log(res);
                res.content = $sce.trustAsHtml(res.content);

                $scope.data.splice(0, 0, res);
                //$scope.alldata.splice(0, 0, res);

                $scope.question.titlee= ' ';
                $scope.question.content= '';
                $scope.question.courses= '';
                $scope.questionTags.selectedTags = '';

            }).error(function(err){
                console.log(err);
            });
         
        }
    };

    //**************************get Tags and Courses for Ask modal********************

    $scope.requestAsk=function(valid){

        
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
            


        }).error(function(err){
            console.log(err);
        });
        
        
        
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
            $scope.status = {
                isopen: false
              };

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


    //*********** get msg number *********
    $scope.getMsgNOtifications=function(){
        $http({
            method:'POST',
            url: 'http://localhost:8000/getmsgnum',
            data:{
                'id':sessionService.get('user'),
                'type':sessionService.get('type')
            }
        }).success(function(res){
            console.log('num of inbox',res[0].count);
            $rootScope.numOfmsg = res[0].count;
        }).error(function(err){
            console.log(err);
        });
    }
    $scope.getMsgNOtifications();


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
            $rootScope.numOfnotification=0;

        }).error(function(err){
            console.log(err);
        });
    };

    //*********************** message page*********************

    $scope.messagePage = function(){

        $location.path('/inbox');
    }

//******************************** get all courses*********************/
    $scope.getallcourse=function(){

        $http({
            method: 'GET',
            url: 'http://localhost:8000/getallcourse',
        }).success(function(res){


            $rootScope.allCourses = res;


        }).error(function(err){
            console.log(err);
        });
    }
    $scope.getallcourse();


    //******************************** get all tags*********************/
    $scope.getalltag=function(){

        $http({
            method: 'GET',
            url: 'http://localhost:8000/getalltag',
        }).success(function(res){


            $rootScope.allTags = res;


        }).error(function(err){
            console.log(err);
        });
    }
    $scope.getalltag();

});




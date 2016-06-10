'use strict';
angular.module('developerMaze').controller('homeCtl',function( $scope , $rootScope,$http,$location,sessionService,$sce){
	
    //**********************Slider Code**************************
   
	$(document).ready(function () {
    $(".owl-carousel").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        dots: true,
        items: 2,
        itemsDesktop : [1199,1],
    	itemsDesktopSmall : [980,1],
    	itemsTablet	: [768,1],
		itemsMobile :	[479,1],
 
       
    });
});
    //**********************************************************

    //*************************Request Data*******************************

    $scope.requestData=function(){

        $http({
            method: 'POST',
            url: 'http://localhost:8000/getuserdata',
            data: {
                'user': sessionService.get('user'),
                'type':sessionService.get('type')
            }
        }).success(function(res){

            console.log(res);
            if(res){
                console.log(res);
                $rootScope.courses = JSON.parse(res.user['course_data']);
                $rootScope.questions = $rootScope.questionsWithoutFilter = JSON.parse(res.user['latest_follow_question']);
                $rootScope.allquestions = $rootScope.allquestionsWithoutFilter = JSON.parse(res.user['latest_all_question']);

                $rootScope.questions = $rootScope.questions.map(function(item){
                item.content = $sce.trustAsHtml(item.content)
                return item;
                });
                $rootScope.allquestions = $rootScope.allquestions.map(function(item){
                item.content = $sce.trustAsHtml(item.content)
                return item;
                });
            }
            
        }).error(function(err){
            console.log(err);
        });
    }

    if($rootScope.currentuser){
       $scope.requestData();   

    }


    //*************************************************************

    //***************** request data for top things *************

    //************************* get four first question *******************************

    $scope.firstfourcourse=function(){

        $http({
            method: 'GET',
            url: 'http://localhost:8000/firstfourcourse',
        }).success(function(res){

            //console.log(res);
            $rootScope.topCourses = res;

        }).error(function(err){
            console.log(err);
        });
    }
    $scope.firstfourcourse();

    //************************* get four latest question *******************************

    $scope.getfourquestion=function(){
        
        $http({
            method: 'GET',
            url: 'http://localhost:8000/getfourquestion',
        }).success(function(res){

            //console.log(res);
            $rootScope.topQuestions = res;

        }).error(function(err){
            console.log(err);
        });
    }
    $scope.getfourquestion();


});


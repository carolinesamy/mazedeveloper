'use strict';
angular.module('developerMaze').controller('homeCtl',function( $scope , $rootScope,$http,$location,sessionService){
	
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


    //***************** request data for top things *************
    //************************* get four first question *******************************

    $scope.firstfourcourse=function(){

        $http({
            method: 'GET',
            url: 'http://localhost:8000/firstfourcourse',
        }).success(function(res){


            console.log(res);


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


            console.log(res);


        }).error(function(err){
            console.log(err);
        });
    }
    $scope.getfourquestion();


});


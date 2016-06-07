'use strict';
angular.module('developerMaze').controller('homeCtl',function( $scope , $rootScope,$http,$location,sessionService){
	
    //**********************Slider Code**************************
   
	$(document).ready(function () {
    $(".owl-carousel").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        dots: true,
        items: 1,
        itemsDesktop : [1199,1],
    	itemsDesktopSmall : [980,1],
    	itemsTablet	: [768,1],
		itemsMobile :	[479,1],
 
       
    });


});
    //**********************************************************


    //***************** request data for top things *************



});


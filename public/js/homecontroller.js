'use strict';
angular.module('developerMaze').controller('homeCtl',function( $scope , $rootScope,$http,$location,sessionService){
	//logged-in user
	// $scope.user = {
 //      email: '',
 //      password: '',
 //      notifications :0
 //    };

   
	$(document).ready(function () {
    $("#owl-carousel").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        dots: true,
        items: 1,
        itemsDesktop : [1199,2],
    	itemsDesktopSmall : [980,1],
    	itemsTablet	: [768,1],
		itemsMobile :	[479,1],
        navigation :true,
       
    });

    $("#owl-carousel-2").owlCarousel({

    	paginationNumbers: true,
        items: 3,
        itemsDesktop : [1199,2],
    	itemsDesktopSmall : [980,1],
    	itemsTablet	: [768,1],
		itemsMobile :	[479,1],

    });
});


});


/*Angular component:Module
**Author:
**name:developerMaze
**desc:
**dep:
*/

angular.module('developerMaze',['ngRoute','ui.bootstrap','ui.codemirror','angularTrix']);

angular.module('developerMaze').config(function($routeProvider){

	$routeProvider.when('/',{
		templateUrl:'templates/views/home.html',
		controller:'homeCtl'
	})

	.when('/questions',{
		templateUrl:'templates/views/questions.html',
		resolve:{
		        "check":function($location,$rootScope,sessionService){ 
    				$rootScope.currentuser = sessionService.get('user');	          	
		            if(!($rootScope.currentuser)){ 
		                $location.path('/');    //redirect user to home.
		            }
		        }
		    },
		controller:'questionsCtl'
	})

	.when('/question',{
		templateUrl:'templates/views/question.html',
		resolve:{
		        "check":function($location,$rootScope,sessionService){ 
    				$rootScope.currentuser = sessionService.get('user');	          	
		            if(!($rootScope.currentuser)){ 
		                $location.path('/');    //redirect user to home.
		            }
		        }
		    },
		controller:'questionCtl'
	})

	.when('/course',{
		templateUrl:'templates/views/course.html',
		resolve:{
		        "check":function($location,$rootScope,sessionService){ 
    				$rootScope.currentuser = sessionService.get('user');	          	
		            if(!($rootScope.currentuser)){ 
		                $location.path('/');    //redirect user to home.
		            }
		        }
		    },
		controller:'courseCtl'
	})
	

	

})


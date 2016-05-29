/*Angular component:Module
**Author:
**name:developerMaze
**desc:
**dep:
*/

angular.module('developerMaze',['ngRoute','ngSanitize','hm.readmore','ui.bootstrap','ui.codemirror','angularTrix','file-model']);

angular.module('developerMaze').config(function($routeProvider){

	$routeProvider.when('/',{
		templateUrl:'templates/views/home.html',
		resolve:{
		        "check":function($rootScope,sessionService){ 

    				$rootScope.currentuser = sessionService.get('user');  					          			            
		        }
		    },
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
		                $location.path('/'); 
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
		                $location.path('/');
		            }
		        }
		    },
		controller:'courseCtl'
	})
	

	

})


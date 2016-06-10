/*Angular component:Module
**Author:
**name:developerMaze
**desc:
**dep:
*/

angular.module('developerMaze',['ngRoute','ngSanitize','hm.readmore','ui.bootstrap','ui.codemirror','angularTrix','file-model','ui.select','btford.socket-io','ngWYSIWYG','angular-loading-bar',"ngTable"]);

angular.module('developerMaze').config(function($routeProvider,cfpLoadingBarProvider){

	 cfpLoadingBarProvider.includeSpinner = false;

	$routeProvider.when('/',{
		templateUrl:'templates/views/home.html',
		resolve:{
		        "check":function($rootScope,sessionService,$location){

    				$rootScope.currentuser = sessionService.get('user');
		        }
		    },
		controller:'homeCtl'
	})

	.when('/questions',{
		templateUrl:'templates/views/questionsNEW.html',
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

	.when('/allquestions',{
		templateUrl:'templates/views/allquestions.html',
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
		templateUrl:'templates/views/questionNEW.html',
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
		controller:'questionsCtl'
	})

	.when('/inbox',{
		templateUrl:'templates/views/inbox.html',
		resolve:{
		        "check":function($location,$rootScope,sessionService){ 
    				
    				$rootScope.currentuser = sessionService.get('user');  					          			            
    				        	
		            if(!($rootScope.currentuser)){ 
		                $location.path('/');
		            }
		        }
		    },
		controller:'inboxCtl'
	})

	.when('/message',{
		templateUrl:'templates/views/message.html',
		resolve:{
		        "check":function($location,$rootScope,sessionService){ 
    				
    				$rootScope.currentuser = sessionService.get('user');  					          			            
    				        	
		            if(!($rootScope.currentuser)){ 
		                $location.path('/');
		            }
		        }
		    },
		controller:'inboxCtl'
	})


	.when('/help',{
		templateUrl:'templates/views/help.html',
		controller:'headerCtl'
	})


})


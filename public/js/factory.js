angular.module('developerMaze').factory('server',function($http){

	return{
		'connect':function(url , method , data){
			return $http({
					url:'http://localhost:8000/'+url,
					method:method
					});
		}

	}
})
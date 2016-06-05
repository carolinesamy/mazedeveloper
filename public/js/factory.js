angular.module('developerMaze').factory('server',function($http){

	return{
		'connect':function(url , method , data){
			if(method =="GET"){
				return $http({
					url:'http://localhost:8000/'+url,
					method:method,
					params:data
					});
			}else{
				return $http({
					url:'http://localhost:8000/'+url,
					method:method,
					data:data
					});
			}
			
		}

	}
})
angular.module('developerMaze').factory('socket', function (socketFactory) {
	return socketFactory({

		ioSocket: io.connect('localhost:7000')
	});
});
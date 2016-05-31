/**
 * Created by Christina on 5/26/16.
 */
'use strict';

angular.module('developerMaze').factory('sessionService',function(){
    return {
        set:function(key,value){
            return localStorage.setItem(key,value);

        },
        get:function(key){
            return localStorage.getItem(key);
        },
        destroy:function(key){
            return localStorage.removeItem(key);
        },

        // logout:function(){
        //   // $location.path('/home');
        //   return sessionService.destroy('user');
        // }
    }
});

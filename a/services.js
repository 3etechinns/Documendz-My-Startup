'use strict';

var a  = angular.module('helperModule', []);

a.factory('commonFunctions',function(){
return {
		random_string: function(){

                function a() {
                    return (((1 + Math.random()) * 65536) | 0).toString(16).substring(1);
                }
                return (a() + a() + a() + a() + a()).toLowerCase();
}
            
}

});



a.factory('userData', function(){

var userData = {};

return {

		getData : function() {
			return userData;
		},
		setData: function(data, type) {
			userData[type] = data;
		}


};

});


a.factory('templateName', function(){

var t = {};

return {

    getData : function() {
      return t;
    },
    setData: function(name) {
      t['name'] = name;
    }


};

});


a.factory('currentCollabs', function(){

var currentCollabs = {};

return {

    getData : function() {
      return currentCollabs;
    },
    setData: function(data, type) {
      currentCollabs[type] = data;
    }


};

});

a.factory('workGroupFunctions', function($rootScope,$http) {

	var param = function(data) {
		//console.log(data);
        var returnString = '';
        for (var d in data){
            if (data.hasOwnProperty(d))
               returnString += d + '=' + data[d] + '&';
        }
        // Remove last ampersand and return
        
        return returnString.slice( 0, returnString.length - 1 );

    };

  

    return {
        
        updateWkgroups: function(data,res){

        	$rootScope.$broadcast('updateWkgroups',data,res);

        },
        saveProj : function(postData){
		
        	
					
		   $http({
		    method : 'POST',
		    url : 'backend/addProject.php',
		    data : param(postData), // pass in data as strings
		    headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
		  })
		               .success(function(res){
		              // 		console.log("added, from services.js");
		               })


				} 


		}
           
});

a.factory('filesDataFunctions',function($http){


return{


  get:function(){

 var promise = $http({
        method : 'POST',
        url : 'backend/fetchActivityFiles.php',
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
      })
        .success(function(data, status, headers, config){
            return data;
            
                   })
 return promise;
  },
}


});

a.factory('collaboratorFunctions',function($http,$rootScope){


	var param = function(data) {
	//	console.log(data);
        var returnString = '';
        for (var d in data){
            if (data.hasOwnProperty(d))
               returnString += d + '=' + data[d] + '&';
        }
        // Remove last ampersand and return
        
        return returnString.slice( 0, returnString.length - 1 );

    };


return{

addCollaborator: function(postData){


	var promise =	   $http({
		    method : 'POST',
		    url : 'backend/addCollaborator.php',
		    data : param(postData), // pass in data as strings
		    headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
		  })
		        .success(function(data, status, headers, config){
						return data;
						
		               })
	return promise;

	},
 
	updateCollaborators: function(data){

		//	console.log(data);

			$rootScope.$broadcast('updateCollaborators',data);

	}
	
}

});

a.factory('socket', function ($rootScope) {

socket = "";

  return {
    set:function(){

        socket = io.connect("https://documendz.com", {'forceNew': true, 'connect timeout': 1000 });
    },

    on: function (eventName, callback) {
      socket.on(eventName, function () {  
        var args = arguments;
        $rootScope.$apply(function () {
          callback.apply(socket, args);
        });
      });
    },
    emit: function (eventName, data, callback) {
      socket.emit(eventName, data, function () {
        var args = arguments;
        $rootScope.$apply(function () {
          if (callback) {
            callback.apply(socket, args);
          }
        });
      })
    },
    disconnect: function () {
       
        socket.disconnect();
        socket.removeAllListeners();
      },
  };
});


a.factory('usables',function(){



return{

  give:function(){

  
  }
}

});


a.factory('Page', function() {
   var title = 'Documendz';
   return {
     title: function() { return title; },
     setTitle: function(newTitle) { title = newTitle }
   };
});

a.factory('CidList', function(){
  var clist = '';
  return {
    setList: function (data) { clist = data;},
    getList: function() {return clist;}
  };
});
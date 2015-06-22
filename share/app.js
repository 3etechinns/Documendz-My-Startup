	// create the module and name it scotchApp
	var scotchApp = angular.module('scotchApp', ['ngRoute','ui.bootstrap','helperModule']);



	// configure our routes
	scotchApp.config(function($routeProvider) {
	    $routeProvider

  .when('/share/:newId', {
  			name: 'publicLink',
	        templateUrl: 'publicTemplate.html',
	        controller: 'publicTemplateController'


	    })

	});

scotchApp.controller('ModalDemoCtrl', function($scope, $modal, $log) {

	    $scope.items = ['item1', 'item2', 'item3'];


	    $scope.open = function(size, modaltype) {

	        var modalInstance = $modal.open({
	            templateUrl: modaltype,
	            controller: 'ModalInstanceCtrl',
	            size: size,
	            resolve: {
	                items: function() {
	                    return $scope.items;
	                }
	            }
	        });

	        modalInstance.result.then(function(selectedItem) {
	            $scope.selected = selectedItem;
	        }, function() {
	            $log.info('Modal dismissed at: ' + new Date());
	        });
	    };
	});


	scotchApp.controller('ModalInstanceCtrl', function(data1, data2, data3, userData, $scope, $routeParams, $modalInstance, workGroupFunctions, $http, commonFunctions, CidList, collaboratorFunctions, filesDataFunctions) {
	  


	    $scope.cancel = function() {

	        $modalInstance.close();
	    };



	




	});
	

// *************  public template controller *************************//

	scotchApp.controller('publicTemplateController', function( $window, Page, $modal, $scope, socket, $routeParams, $rootScope, $route, $location, $http) {

	    Page.setTitle('Documendz');

	    $scope.defDp = "https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100";


	    $window.ga('send', 'pageview', {
	        page: "PublicTemplate"
	    });


		$scope.ell = "";

	    $scope.$watch('ell', function() {

	    	if($scope.ell == ""){}
	    	else{

	    			    socket.set();



	    function socketConnected() {

	        socket.emit("documentInfo", {
	            shareId: shareId,
	            userId: "x",
	            name: $scope.ell
	        });
	    };

	    socket.on("connect", socketConnected);
	    socket.on("getChangeData", getChangeData);
	    socket.on("sendUserMap", sendUserMap); // keval chat
	    console.log(socket);






	    $scope.$on("$destroy", function() {
	        socket.disconnect();

	        console.log(socket);

	    });
	    	}	
	    

	     });




	});



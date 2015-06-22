	// create the module and name it scotchApp
	var scotchApp = angular.module('scotchApp', ['cgBusy','ngRoute', 'ngTagsInput', 'angular-ladda', 'ngCookies', 'ui.bootstrap', 'helperModule', 'angularFileUpload', 'xeditable','inform']);





	// configure our routes
	scotchApp.config(function($routeProvider) {
	    $routeProvider


	    // route for the home page
	        .when('/workgroups', {
	        templateUrl: 'pages/home.html',

	    })

	    .when('/workgroups/:wgId', {
	        templateUrl: 'pages/files.html',
	        controller: 'filesController',



	    })

	    .when('/workgroups/:wgId/list', {
	        templateUrl: 'pages/filesList.html',
	        controller: 'filesController'

	    })

	    .when('/workgroups/:wgId/:fileId', {
	        templateUrl: 'template.html',
	        controller: 'templateController'


	    })
	    .when('/workgroups/:g/:wgId/:fileId', {
	        templateUrl: 'template.html',
	        controller: 'templateController'


	    })

	    .when('/workgroups/sample/:wgId/:s/:fileId', {
	        templateUrl: 'sampleTemplate.html',
	        controller: 'templateController'

	    })

	         .when('/workgroups/revisions/:wgId/version/:fileId', {
	        templateUrl: 'versionTemplate.html',
	        controller: 'templateController'


	    })

	      .when('/workgroups/:wgId/:fileId/user/files/activity', {
	        templateUrl: 'pages/activity.html',
	        controller: 'activityController'


	    })

	    // route for the about page
	    .when('/account/:id', {
	        templateUrl: 'pages/myaccount.html',
	        controller: 'accountController'
	    })

	      .when('/faq', {
	        templateUrl: 'pages/faq.html',
	        controller: 'faqController'
	    })

	    // route for the denied page
	    .when('/denied', {
	        templateUrl: 'pages/noperm.html',
	        controller: 'deniedController'
	    })

	      .when('/logout',{
	    	templateUrl:'pages/logout.html',
	    	controller:'logoutController'
	    })


	});


	scotchApp.run(function(editableOptions) {
	    editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
	});

  scotchApp.directive('errSrc', function() {
      return {
        link: function(scope, element, attrs) {
          element.bind('error', function() {
            if (attrs.src != attrs.errSrc) {
              attrs.$set('src', attrs.errSrc);
            }
          });
          
          attrs.$observe('ngSrc', function(value) {
            if (!value && attrs.errSrc) {
              attrs.$set('src', attrs.errSrc);
            }
          });
        }
      }
    });

scotchApp.directive('backButton', ['$window', function($window) {
        return {
            restrict: 'A',
            link: function (scope, elem, attrs) {
                elem.bind('click', function () {
                    $window.history.back();
                });
            }
        };
    }]);

scotchApp.directive('confirmation', function () {  // for asking confirmation
  return {
    priority: 1,
    terminal: true,
    link: function (scope, element, attr) {
      var msg = attr.confirmation || "Are you sure?";
      var clickAction = attr.ngClick;
      element.bind('click',function () {
        if ( window.confirm(msg) ) {
          scope.$eval(clickAction)
        }
      });
    }
  };
});

	scotchApp.filter('dateToISO', function() {
	    return function(input) {
	        return new Date(input).toISOString();
	    };
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


	scotchApp.controller('ModalInstanceCtrl', function(data1, CidList,userData, $scope, $routeParams, $modalInstance, workGroupFunctions, $http, commonFunctions, collaboratorFunctions) {
	    $scope.newProj = {};
	    $scope.newCollab = {};

	    $scope.fname = data1;

$scope.states=[''];

if(userData.getData().emailList){
$scope.states = userData.getData().emailList;
}

function add_notif(wid,type,cid,name){


var dataObj = {
				wid : wid,
				type : type,
				cid : cid,
				name: name
		};	

$http({
    method: 'POST',
    url: 'backend/addNotification.php',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    transformRequest: function(obj) {
        var str = [];
        for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        return str.join("&");
    },
    data: dataObj
}).success(function(res){

	console.log(res);
});


		
 }

	    $scope.cancel = function() {

	        $modalInstance.close();
	    };

	    $scope.saveProject = function() {
	        $scope.newProj['rnd'] = commonFunctions.random_string();

	    
	        workGroupFunctions.saveProj($scope.newProj);
	        $modalInstance.close();
	        $scope.updateData = {
	        	wname:$scope.newProj.projectName,
	        	wdesc:$scope.newProj.projectDesc
	        }
	        workGroupFunctions.updateWkgroups($scope.updateData, $scope.newProj['rnd']);
	        $scope.newProj.projectName = "";
	    };

 $scope.sendFeedback = function() {
	    	
	    	$modalInstance.close();
	        $http({
	                method: 'POST',
	                url: 'backend/sendFeedback.php',
	                data: 'msg=' + $scope.fb.feedbackMessage, // pass in data as strings
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                }
	            })
	            

	    };

   $scope.increaseLimit = function(par){

     $modalInstance.close();
     
	    	$http({
	                    method: 'POST',
	                    url: 'backend/increaseLimit.php?p='+par,
	                    headers: {
	                        'Content-Type': 'application/x-www-form-urlencoded'
	                    }
	                })

	    	   $scope.msg = {
	                content: 'Thanks for your interest. We will get back to you soon.',
	                options: {
	                    ttl: 6000,
	                    type: 'warning',
	                    html: true
	                }
	            }
	            inform.add($scope.msg.content, $scope.msg.options);


	    };

	    $scope.addCollab = function() {

	        $scope.newCollab['wgId'] = $routeParams.wgId;
	        var a = $scope.newCollab.email;


	        collaboratorFunctions.addCollaborator($scope.newCollab).then(function(promise) {

	            if (promise.data == 1) {
	                $scope.errorMessage = "Collaborator already present in workgroup";
	                $scope.successMessage = "";
	            } else if (promise.data == 2) {
	                $scope.errorMessage = "Collaborator already present in workgroup";
	                $scope.successMessage = "";
	            } else if (promise.data == 3) {
	                $scope.successMessage = "Email sent successfully";
	                $scope.errorMessage = "";

	                collaboratorFunctions.updateCollaborators({

	                    authId: userData.getData().userid,
	                    collabEmail: a,
	                    collabName: a,
	                    wkUniqueId: $scope.newCollab['wgId']
	                });
	            }
	        });

	        var cx = CidList.getList();
	        add_notif($routeParams.wgId,3,JSON.stringify(cx),a);

	        $scope.newCollab.email = ""; // Empty the input field
	        $modalInstance.close();
	    };


	     $scope.onTextClick = function ($event) {
 				   $event.target.select();
		}

		$scope.sendPublicLink= function(){

			$scope.sendingPublic = true;
			console.log($scope.emails);
			console.log($scope.message);

			   var dataObj = {
	                emails:JSON.stringify($scope.emails),
	                message: $scope.message,
	                link:"https://documendz.com/share/#/public/"+$scope.fname
	            };
	            
	         var s = $http({
	                method: 'POST',
	                url: 'backend/sendPubliclink.php',
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                },
	                transformRequest: function(obj) {
	                    var str = [];
	                    for (var p in obj)
	                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
	                    return str.join("&");
	                },
	                data: dataObj
	            });
	         s.success(function(res){

	         	console.log(res);
	         	$scope.sendingPublic = false;
	         	$modalInstance.close();
	         	 $scope.msg = {
	                content: 'The link has been sent!',
	                options: {
	                    ttl: 6000,
	                    type: 'success',
	                    html: true
	                }
	            }
	            inform.add($scope.msg.content, $scope.msg.options);
	         })

		}

	});


	scotchApp.controller('mainController', function(Page, inform,$modal, userData, $window, workGroupFunctions, $scope, $routeParams, $http, $rootScope, userData, $location,$filter) {

	    // 	console.log(userData.getData());
	    // 	userData.setData('Vipul', 'name');
	    // console.log(userData.getData());
	    // userData.setData('14','age');
	    // console.log(userData.getData());
  $rootScope.gfiles = "";
$window.ga('send', 'pageview', { page: "Workgroup" }); 

 var mc0 = $http.get("backend/checkLoggedIn.php");
	        
	     mc0.success(function(res) {

	            if (res != 1) {
	            	


	                $window.location.href = "https://www.documendz.com";

	            }
	        });
	        mc0.error(function() {

	        });



  $scope.inform = inform;
  $scope.Page = Page;

  $scope.defDp = "https://d28kungomln1xp.cloudfront.net/images/unknown_dp.jpg";

$scope.$on('$routeChangeStart', function() { 
Page.setTitle('Workgroups - Documendz');   
 });


  $scope.msg = {
    content: 'This feature lets you <b>archive</b> your completed projects.<br> It will soon be available.',
    options: {
      ttl: 3500,
      type: 'info',
      html: true
    }
  }

    $scope.add = function(msg) {
    inform.add(msg.content, msg.options);
  };

	    $scope.workgroupParams = {};
	    $scope.allFiles="";
    $scope.status = { //for multiple dropdowns

	        isopen1: false,
	        isopen2: false,
	        isopen3: false,
	        isopen5: false
	        
	    };

$scope.emToggle = false;  //is-open="emToggle"
$scope.fiToggle = false;

	  



	 var mc1=   $http.get("backend/fetch.php");
	        
	        mc1.success(function(data) {

	            userData.setData(data[0].userid, 'userid');


	            $scope.userData = data;
	            $scope.pt = data[0].userid;
	            $scope.ut = data[0].username;
	            $scope.flimit = data[0].files;
	            $scope.ver = data[0].versions;
	            $scope.smm = data[0].summary;
	            $scope.climit = data[0].collaborators;
	         


	        });

	        mc1.error(function() {
	            $scope.data = "error in fetching data";
	        });


	  $scope.mc2 =  $http.get("backend/fetch_workgroups.php");
	        $scope.mc2.success(function(data) {

          if(!data['wg']){
                $scope.workgroupParams.count = 0;
                $scope.myWorkgroupCount = 0;
                $scope.wgData = [];
         		// alert("workgroup blank");
         }
         else{
	            $scope.wgData = data['wg'];
	            $scope.emData = data['emails'];
	            $scope.workgroupParams.count = data['wg'].length;

	            $scope.myWorkgroupCount = $filter('filter')($scope.wgData,{auth_id : userData.getData().userid}).length;
	            

	         //   console.log( "wgdata: " + $scope.wgData);

	        //    console.log("Total workgroups: " + $scope.workgroupParams.count);
	          }
	        })
	        .error(function() {
	            //error
	        });

$scope.getNotif = function(val){



var not = $http.get("backend/getNotification.php?v="+val);

not.success(function(data){

	$scope.notifs = data;
$scope.unreadcount = 0;

var pagesShown = 1;
    var pageSize = 4;
    
    $scope.itemsLimit = function() {
        return pageSize * pagesShown;
    };
    $scope.hasMoreItemsToShow = function() {
        return pagesShown < ($scope.notifs.length / pageSize);
    };
    $scope.showMoreItems = function() {
        pagesShown = pagesShown + 1;         
    };

	console.log(data);

	angular.forEach(data, function(value, key) {
		if(value.read == 0) {
			$scope.unreadcount += 1;
		}
	});

})


};
	$scope.getNotif('0');

 var fd = $http.get('https://www.google.com/m8/feeds/contacts/default/full?v=3.0&access_token='+localStorage.getItem("dcz_tkn")+'&max-results=1000&v=3.0&alt=json');
fd.success(function(data,status){


$scope.states = [];
angular.forEach(data.feed.entry, function(value, key) {

  if(value.gd$email)	{
  
$scope.states.push(value.gd$email[0].address);
  // console.log(value.gd$email[0].address);
}
});

userData.setData($scope.states,"emailList");

});


	    $scope.addWorkgGroup = function() {


	            $modal.open({
	                templateUrl: 'myModalContent.html',
	                controller: 'ModalInstanceCtrl',
	                size: '',
	                resolve: {
	                data1: function() {
	                    return null;
	                   }
	                 }
	            });

	        
	    }


	   var mc3 = $http.get("backend/fetch.php");
	        
	        mc3.success(function(data) {

	            userData.setData(data[0].userid, 'userid');


	            $scope.userData = data;
	            $scope.pt = data[0].userid;


	        });
	        
	        mc3.error(function() {
	            $scope.data = "error in fetching data";
	        });


	   





	    $scope.deleteWkgroup = function(del_id,s) {

	        var elementPos = $scope.wgData.map(function(x) {
	            return x.uniqueId;
	        }).indexOf(del_id);
	        var objectFound = $scope.wgData[elementPos];
	        var idx = $scope.wgData.indexOf(objectFound);
	        $scope.wgData.splice(idx, 1);
	        $scope.workgroupParams.count = $scope.wgData.length;
	        $scope.myWorkgroupCount = $filter('filter')($scope.wgData,{auth_id : userData.getData().userid}).length;
	      //  console.log($scope.workgroupParams.count);

	        $http({
	                method: 'POST',
	                url: 'backend/deleteWkgroup.php',
	                data: "del_id=" + del_id, // pass in data as strings
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                }
	            })
	            // .success(function(res) {

	                

	            // })

	    };





	    $scope.$on('updateWkgroups', function(event, data, unique_id) {
	        //push into scope for wkgroups
	     //   console.log($scope.wgData);
	        
	        $scope.t = new Date();

	        $scope.wgData.push({
	            uniqueId: unique_id,
	            auth_id: $scope.pt,
	            wname: data.wname,
	            wdesc:data.wdesc,
	            auth_name:"Me",
	            time: $scope.t,
	            sample:0
	        });
	        $scope.workgroupParams.count = $scope.wgData.length;
	         $scope.myWorkgroupCount = $filter('filter')($scope.wgData,{auth_id : userData.getData().userid}).length;
	    });

	    $scope.askFeedback = function() {


	        $modal.open({
	            templateUrl: 'feedback.html',
	            controller: 'ModalInstanceCtrl',
	            size: '',
	            resolve: {
	                data1: function() {
	                    return null;
	                   }
	                 }
	        });


	    };

	});



	scotchApp.controller('accountController', function($window,Page, $scope, userData, $http, inform) {
		
		Page.setTitle('Account Details - Documendz');

$window.ga('send', 'pageview', { page: "MyAccount" }); 

		$scope.accountInfo = {
				Username: $scope.userData[0].username,
	            Email: $scope.userData[0].emailid,
	            StartDate: $scope.userData[0].start

		};
	    
	    

   $scope.defDp = "https://d28kungomln1xp.cloudfront.net/images/unknown_dp.jpg";

    
	    
	    $scope.workgroupscount = $scope.wgData.length;

	     $scope.changePassword = function(){
                    

                     $http({
	                    method: 'POST',
	                    url: 'backend/changePassword.php',
	                    data: "old_pass=" + $scope.abc.oldPass + "&new_pass=" + $scope.abc.newPass, // pass in data as strings
	                    headers: {
	                        'Content-Type': 'application/x-www-form-urlencoded'
	                    }
	                })
	                .success(function(res) {

	                    
	                    $scope.abc.oldPass = "";
	                    $scope.abc.newPass = "";

	                    if(res == 0){

	                    	$scope.failuremsg = {
    content: 'Oops! Current password entered is incorrect. Please try again.',
    options: {
      ttl: 6000,
      type: 'warning',
      html: true
    }
  }
  
	                    	inform.add($scope.failuremsg.content, $scope.failuremsg.options);

	                    }
	                    else{

	                    	$scope.successmsg = {
    content: 'Password changed succesfully!',
    options: {
      ttl: 6000,
      type: 'success',
      html: true
    }
  }

	                    	inform.add($scope.successmsg.content, $scope.successmsg.options);

	                    }


	                })

	    };

 
$http.get("backend/countAllFiles.php")
	        .success(function(res) {

	        		$scope.totalFileCount = parseInt(res);

	            // alert("current used:"+res);
	            // console.log(typeof($scope.totalFileCount));
	        })
	        .error(function() {

	        });
       

	});



	scotchApp.controller('filesController', function(CidList,currentCollabs,$window,templateName, Page, filesDataFunctions,$scope,$rootScope, $http, $routeParams, userData,$modal,$upload, $cookies, $timeout,$location,inform) {

// check permissions to the wkgroup: either the author or is a collab
	    	    Page.setTitle('Files - Documendz');

 $scope.defDp = "https://d28kungomln1xp.cloudfront.net/images/unknown_dp.jpg";

$window.ga('send', 'pageview', { page: "Files" }); 

        $http({
	            method: 'POST',
	            url: 'backend/wkgroupPermission.php',
	            data: "w=" + $routeParams.wgId, // pass in data as strings
	            headers: {
	                'Content-Type': 'application/x-www-form-urlencoded'
	            }
	        })
	        .success(function(res) {

	            if (res != 1) {
	            	$location.path("/denied");

	            }
	        })
	        .error(function() {

	        });

			    $scope.totalFileCount = 0;

      function updateFileCount(){

      	$http.get("backend/countAllFiles.php")
	        .success(function(res) {

	        		$scope.totalFileCount = parseInt(res);

	            // alert("current used:"+res);
	            // console.log(typeof($scope.totalFileCount));
	        })
	        .error(function() {

	        });


}

updateFileCount();

function add_notif(wid,type,cid,name){


var dataObj = {
				wid : wid,
				type : type,
				cid : cid,
				name: name
		};	

$http({
    method: 'POST',
    url: 'backend/addNotification.php',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    transformRequest: function(obj) {
        var str = [];
        for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        return str.join("&");
    },
    data: dataObj
});

//bhcf
		
 }

$scope.search = function (item){
	
    // if (item.filename.indexOf($scope.query)!=-1 || item.authname.indexOf($scope.query)!=-1) {
    //         return true;
    //     }
    //     return false;
 return !!((item.filename.indexOf($scope.query || '') !== -1 || (item.authname.indexOf($scope.query || '')) !== -1));


  };

	    $scope.predicate = "uploadtime"; //for sort 
	    $scope.reverse = "true";
	    $scope.isDisabled = "";

	    $scope.wg = $routeParams.wgId; //used for list and grid view

	    // for workgroupname on filespage
	    var e = $scope.wgData.map(function(x) {
	        return x.uniqueId;
	    }).indexOf($routeParams.wgId);
	    $scope.wname = $scope.wgData[e].wname;
 		
 		$scope.wkgroupAuthId = $scope.wgData[e].auth_id;
	    $scope.wkgroupAuthName = $scope.wgData[e].auth_name;

	    // fetch Files

	    $http({
	            method: 'POST',
	            url: 'backend/fetchFiles.php',
	            data: "wid=" + $routeParams.wgId, // pass in data as string
	            headers: {
	                'Content-Type': 'application/x-www-form-urlencoded'
	            }
	        })
	        .success(function(data) {
	            
	            $scope.allFiles = data;
	    

	        });


    var frv = $http({
			        method: 'POST',
			        url: 'backend/fetchFileRevisions.php',
			        data: "wid=" + $routeParams.wgId, // pass in data as string
			        headers: {
			            'Content-Type': 'application/x-www-form-urlencoded'
			        }
    				});

				    frv.success(function(data) {
				        $scope.revisions = data;
				        console.log("versions are:");
				        console.log(data);
				        // $scope.isDisabled = ($scope.allFiles.length >= 4) ? "true" : "false";

				        console.log( $scope.revisions);
				    });

var au = {

	userid: $scope.wkgroupAuthId,
	collabName: $scope.wkgroupAuthName

}
	            

	    // fetch collaborators
var cid = [];

	    $http({
	            method: 'POST',
	            url: 'backend/fetchCollaborators.php',
	            data: "wid=" + $routeParams.wgId, // pass in data as strings
	            headers: {
	                'Content-Type': 'application/x-www-form-urlencoded'
	            }
	        })
	        .success(function(data) {

	              $scope.collabData = data;

	            $scope.collabData.push(au);

	            currentCollabs.setData($scope.collabData, "colls");

	            		angular.forEach($scope.collabData, function(value, key) {					  
					if (value.userid != $scope.pt) {
					cid.push(value.userid);
					  }
			    });
			    CidList.setList(cid);

	        });

	    $scope.$on('updateCollaborators', function(event, data) {
	        //push into scope for collabData

	       $scope.collabData.push(data);
	        currentCollabs.setData(data, "colls");

	    });



	    $scope.removeCollaborator = function(collabEmail, wkUniqueId) {


	        var elementPos = $scope.collabData.map(function(x) {
	            return x.collabEmail;
	        }).indexOf(collabEmail);
	        var objectFound = $scope.collabData[elementPos];
	        var idx = $scope.collabData.indexOf(objectFound);
	        $scope.collabData.splice(idx, 1);



	        $http({
	                method: 'POST',
	                url: 'backend/removeCollaborator.php',
	                data: "collabEmail=" + collabEmail + "&wkGroupId=" + wkUniqueId, // pass in data as strings
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                }
	            })
	            .success(function(res) {

	                // alert("done");
	                add_notif($routeParams.wgId,4,JSON.stringify(cid),collabEmail);

	            })

	    };


	    $scope.deletefile = function(file_unique,file_ext,s) {

	        var elementPos = $scope.allFiles.map(function(x) {
	            return x.uniqueFilename;
	        }).indexOf(file_unique);
	        var objectFound = $scope.allFiles[elementPos];
	        var idx = $scope.allFiles.indexOf(objectFound);
	       
	        var filename = $scope.allFiles[idx].filename; //name to be taken before splice

	        $scope.allFiles.splice(idx, 1);



	        $http({
	                method: 'POST',
	                url: 'backend/deleteFile.php',
	                data: "unique_file=" + file_unique  + "&ext=" + file_ext, // pass in data as strings
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                }
	            })
	            // .success(function(res) {

	           add_notif($routeParams.wgId,2,JSON.stringify(cid),filename);

	            // })
updateFileCount();
	    };


$scope.deleteVersion = function(uniqueVerId,file_ext){

                    var e = $scope.revisions.map(function(x) {
	                    return x.verUniqueFilename;
	                }).indexOf(uniqueVerId);
	                var objectFound = $scope.revisions[e];
	                var idx = $scope.revisions.indexOf(objectFound);
	                
	                $scope.revisions.splice(idx, 1);

	                 $http({
	                            method: 'POST',
	                            url: 'backend/deleteRevisionFile.php',
	                            data: "v=" + uniqueVerId +'&ext ='+ file_ext, // pass in data as strings
	                            headers: {
	                                'Content-Type': 'application/x-www-form-urlencoded'
	                            }
	                        })

	            	};


	    $scope.inviteCollab = function() {

if ($scope.wkgroupAuthId == $scope.pt){

	        if($scope.collabData.length >= $scope.climit){

	        $modal.open({
	            templateUrl: 'collabLimitReached.html',
	            controller: 'ModalInstanceCtrl',
	            size: '',
	            resolve: {
	                data1: function() {
	                    return null;
	                   }
	                 }
	        });
	        
	        }
	        else{
				
			$modal.open({
	            templateUrl: 'invite.html',
	            controller: 'ModalInstanceCtrl',
	            size: '',
	            resolve: {
	                data1: function() {
	                    return null;
	                   }
	                 }

	        });


	        }
}

else{



  $scope.msg = {
    content: 'Only the workgroup owner can add/remove collaborators.<br> The extended collaborator permissions would soon be available.',
    options: {
      ttl: 6000,
      type: 'warning',
      html: true
    }
  }
    inform.add($scope.msg.content, $scope.msg.options);
}

	       };



	    $scope.pt1 = "https://www.documendz.com/iframe_upload.php";

$scope.errSrc = "https://s3-ap-southeast-1.amazonaws.com/docs-test/loading.gif";



// $scope.run = 0;

//  $scope.$watch('run', function() {
//  	if($scope.run != 0){
//  		$http({
// 	            method: 'POST',
// 	            url: '../trial.php',
// 	            data: "u=" + $scope.run.trim() , // pass in data as strings
// 	            headers: {
// 	                'Content-Type': 'application/x-www-form-urlencoded'
// 	            }
// 	        })
// 	        .success(function(data) {

	            
// 	            console.log(data);
// 	            $scope.tr = 1;
       			
	
// 	        });

//  	}
       
//    });

 var poll = function(data) {
  	$scope.n = data;
        $timeout(function() {

        $http.get('https://s3-ap-southeast-1.amazonaws.com/documendz-ent/uploaded/user_'+userData.getData().userid+'/thumbnails/'+$scope.n+'.jpg')
    .success(function (data, status, headers, config) {
        $scope.tr = 1;
    }).error(function (data, status, headers, config) {
       
        poll($scope.n);
        
});
            
        }, 3500);
    };


  function uploadTrigger(i) {

	        if (gfile != "") { 
	        	var extCheck = {


	                    "image/png": "png",
	                    "image/svg+xml": "svg",
	                    "application/x-shockwave-flash": "swf",
	                    "image/jpeg": "jpg",
	                    "image/bmp": "bmp",
	                    "application/pdf": "pdf",
	                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document": "docx"

	                };
	                console.log(gfile);



	            	   $scope.showProgress = 0;
				        $scope.progressValue = 0;
				        $scope.stopSpin = 0;
				        $scope.totalFileCount = 0;
	                    var fileExt = gfile[i].type;



	               

	                if (extCheck[fileExt] != undefined)

	                {

	                    $scope.fileName = gfile[i].name;

	                    // angular.element(document.querySelector('.uploader-file-name').innerHTML = $scope.fileName);
	                    angular.element(document.querySelector('.progress-holder'))[0].style.display = "block";

	                    console.log("ata");

	                    $upload.upload({
	                        url: "../iframe_upload.php",
	                        method: 'POST',
	                        file: gfile[i],
	                        data: {
	                            wgId: $routeParams.wgId
	                        },
	                    }).progress(function(evt) {

	                        $scope.showProgress = 1;
	                      	

	                        $scope.progressValue = parseInt(100.0 * evt.loaded / evt.total);

	                        try{
	                        angular.element(document.querySelector('.pe'+i).innerHTML = "Uploading");
	                        angular.element(document.querySelector('.pb'+i))[0].style.width = $scope.progressValue + "%";


	                        if ($scope.progressValue == 100) {
	                           angular.element(document.querySelector('.pe'+i).innerHTML = "Processing");
	                        }

	                        }
	                        catch(e){}


	                    }).success(function(data, status, headers, config) {
	                        // file is uploaded successfully
	                        console.log('file is uploaded successfully. Response: ' + data);
	                        $scope.stopSpin = 1;

	                        try{
	                        angular.element(document.querySelector('.pe'+i).innerHTML = "<i class='fa fa-check-circle-o' style='font-size: 17px;margin-top:-5px'></i>");
	                        angular.element(document.querySelector('.progress-holder'))[0].style.display = "none";

	                       }
	                       catch(e){

	                       }
	                        if (data == 999) {
	                            $scope.filetype_msg = {
	                                content: 'Oops! Something seems to have gone wrong.',
	                                options: {
	                                    ttl: 8000,
	                                    type: 'danger',
	                                    html: true
	                                }
	                            }
	                            inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);
	                        } else {
	                            $scope.allFiles.push({
	                                authid: userData.getData().userid,
	                                fid: "0",
	                                filename: $scope.fileName,
	                                uniqueFilename: data,
	                                authname: $scope.userData[0].username,
	                                uploadtime: new Date(),
	                                workgroupid: $routeParams.wgId,
	                                extension: extCheck[fileExt],
	                                sample: 0
	                            });
	                            $scope.predicate = "uploadtime"; //for sort 
	                            $scope.reverse = "false";
	                            console.log($scope.allFiles);
	                            //$scope.run = data;
	                            poll(data);
	                        }
	                       	$scope.fileName = "";
	                        updateFileCount();
	                        console.log(JSON.stringify(cid));
	                        add_notif($routeParams.wgId, 1, JSON.stringify(cid), $scope.fileName);
	                        if(i<gfile.length-1) {
	                        uploadTrigger(i+1);
	                        }
	                        else {
	                        	console.log("done");
	                        }
	                    });


	                } else {

	                	 if(i<gfile.length-1) {
	                        uploadTrigger(i+1);
	                        }
	                        else {
	                        	console.log("done");
	                        }

	                    $scope.filetype_msg = {
	                        content: 'Currently supports only .png, .bmp, .jpg, .svg, .swf, .doc, .docx and .pdf file types.<br><br> We are working on adding more file types <i class="fa fa-smile-o"></i>',
	                        options: {
	                            ttl: 8000,
	                            type: 'danger',
	                            html: true
	                        }
	                    }
	                    inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);

	                }

	           
	        } //if file != '' ends

	    }

	    var gfile;
   $scope.uploadFile1 = function(file) {
	     if($scope.totalFileCount + file.length <= $scope.flimit) {
gfile = file;
$rootScope.gfiles = file;
// for(var i = 0; i<file.length; i++) {
// }
uploadTrigger(0);
}
else {
	alert("You cannot upload so many files as per your account limits");
}



	    }

	  
	      	    $scope.uploadFile = function(file) {
	        $scope.showProgress = 0;
	        $scope.progressValue = 0;
	        $scope.stopSpin = 0;

	         $scope.wa = 1;

	        if (file != "") {


	            // console.log(file[0]);

	            var extCheck = {


	                "image/png": "png",
	                "image/svg+xml": "svg",
	                "application/x-shockwave-flash": "swf",
	                "image/jpeg": "jpg",
	                "image/bmp": "bmp",
	                "application/pdf": "pdf",
	                "application/vnd.openxmlformats-officedocument.wordprocessingml.document": "docx",
	                "application/msword": "doc"

	            };


	            if (extCheck[file[0].type] != undefined && file[0].size < 4096000)

	            {

	                $scope.fileName = file[0].name;

angular.element( document.querySelector('.uploader-file-name').innerHTML = $scope.fileName);
angular.element( document.querySelector( '.progress-holder' ))[0].style.display = "block";

angular.element( document.querySelector('.prog-event').innerHTML = "Uploading");

	                $upload.upload({
	                    url: "../iframe_upload.php",
	                    method: 'POST',
	                    file: file[0],
	                    data: {
	                        wgId: $routeParams.wgId
	                    },
	                }).progress(function(evt) {

	                    $scope.showProgress = 1;
	                    $scope.progressValue = parseInt(100.0 * evt.loaded / evt.total);

angular.element( document.querySelector( '.progress-bar' ))[0].style.width= $scope.progressValue+ "%";

if($scope.progressValue == 100){
 angular.element( document.querySelector('.prog-event').innerHTML = "Processing");
}

	                }).success(function(data, status, headers, config) {
	                    // file is uploaded successfully
	                   
	                    $scope.stopSpin = 1;
	                    $scope.fileName = "";
	                     $scope.wa = 0;


angular.element( document.querySelector('.prog-event').innerHTML = "Done");

$timeout(function(){
	angular.element( document.querySelector( '.progress-holder' ))[0].style.display = "none";
},4000);



	                    if (data == 999) {
	                        $scope.filetype_msg = {
	                            content: 'Oops! Something seems to have gone wrong.',
	                            options: {
	                                ttl: 8000,
	                                type: 'danger',
	                                html: true
	                            }
	                        }
	                        inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);
	                    } else {

	                        $scope.allFiles.push({
	                            authid: userData.getData().userid,
	                            fid: "0",
	                            filename: file[0].name,
	                            uniqueFilename: data,
	                            authname: $scope.userData[0].username,
	                            uploadtime: new Date(),
	                            workgroupid: $routeParams.wgId,
	                            extension: extCheck[file[0].type],
	                            sample: 0
	                        });
	                        $scope.predicate = "uploadtime"; //for sort 
	                        $scope.reverse = "false";
	                        //console.log($scope.allFiles);
	                        //$scope.run = data;
	                        poll(data);
	                    }
	                     updateFileCount();
	                      add_notif($routeParams.wgId,1,JSON.stringify(cid),file[0].name);

	                });


	            } else {

	            	$scope.wa = 0;
	                $scope.filetype_msg = {
	                    content: 'We currently support .png, .bmp, .jpg, .svg, .swf, .doc, .docx and .pdf file types all upto 4MB.<br><br> We are working on adding more file types <i class="fa fa-smile-o"></i>',
	                    options: {
	                        ttl: 8000,
	                        type: 'danger',
	                        html: true
	                    }
	                }
	                inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);

	            }

	        }
	    }
	 $scope.uploadFileRevision = function(file, fid) {
    console.log("fid is ");
    console.log(fid);
   
    $scope.stopSpin = 0;

    if (file != "") {
        console.log(file[0]);
        var extCheck = {
            "image/png": "png",
            "image/svg+xml": "svg",
            "application/x-shockwave-flash": "swf",
            "image/jpeg": "jpg",
            "image/bmp": "bmp",
            "application/pdf": "pdf",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document": "docx"
        };

        if (extCheck[file[0].type] != undefined)
        {
            $scope.fileName = file[0].name;

angular.element( document.querySelector('.uploader-file-name').innerHTML = $scope.fileName);
angular.element( document.querySelector( '.progress-holder' ))[0].style.display = "block";

         var prm =  $upload.upload({
                url: "../revision_upload.php",
                method: 'POST',
                file: file[0],
                data: {
                    wgId: $routeParams.wgId,
                    ogFile: fid.trim()
                },
            });
         prm.progress(function(evt) {
                $scope.showProgress = 1;
                $scope.progressValue = parseInt(100.0 * evt.loaded / evt.total);

angular.element( document.querySelector( '.progress-bar' ))[0].style.width= $scope.progressValue+ "100px";
if($scope.progressValue > 80){
 angular.element( document.querySelector('.prog-event').innerHTML = "Processing");

}                

            }).success(function(data, status, headers, config) {
                // file is uploaded successfully
                
                $scope.stopSpin = 1;
                $scope.fileName = "";

angular.element( document.querySelector('.prog-event').innerHTML = "Done");
$timeout(function(){
	angular.element( document.querySelector( '.progress-holder' ))[0].style.display = "none";
},4000);
                
                if (data == 999) {
                    $scope.filetype_msg = {
                        content: 'Oops! Something seems to have gone wrong.',
                        options: {
                            ttl: 8000,
                            type: 'danger',
                            html: true
                        }
                    }
                    inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);

                } else {

                    $scope.revisions.push({
                        ver_authid: userData.getData().userid,
                        verFid: "0",
                        filename: file[0].name,
                        verUniqueFilename: data,
                        parentUniqueFilename: fid,
                        authname: $scope.userData[0].username,
                        verUploadtime: new Date(),
                        verExtension: extCheck[file[0].type]
                    });
                }


            });

        } else {
            $scope.filetype_msg = {
                content: 'Currently supports only .png, .bmp, .jpg, .svg, .swf, .doc, .docx and .pdf file types.<br><br> We are working on adding more file types <i class="fa fa-smile-o"></i>',
                options: {
                    ttl: 8000,
                    type: 'danger',
                    html: true
                }
            }
            inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);
        }
    }
}
		
	
 $scope.increaseFileLimit = function(){

	 	
	    	$http({
	                    method: 'POST',
	                    url: 'backend/increaseLimit.php?p=files',
	                    headers: {
	                        'Content-Type': 'application/x-www-form-urlencoded'
	                    }
	                })

	    	   $scope.msg = {
	                content: 'Thanks for your interest. We will get back to you soon.',
	                options: {
	                    ttl: 6000,
	                    type: 'warning',
	                    html: true
	                }
	            }
	            inform.add($scope.msg.content, $scope.msg.options);


	    };      
// ----------- setting filename to display on template ------------ //

$scope.setName = function(name){

templateName.setData(name);

};


	});


	scotchApp.controller('templateController', function(userData,currentCollabs,$window,templateName, Page, $scope,usables,socket,$routeParams,$rootScope,$route,$location,$http,inform,$modal) {

		Page.setTitle('Document - Documendz');

$window.ga('send', 'pageview', { page: "Template" }); 

$http.get("backend/getSession.php")
	        .success(function(res) {

	            if (res == 0) {
	                $window.location.href = "https://www.documendz.com";

	            }
	            else{

	            	
	            }

	        })
	        .error(function() {

	        });

    $http({
	            method: 'POST',
	            url: 'backend/wkgroupPermission.php',
	            data: "w=" + $routeParams.wgId, // pass in data as strings
	            headers: {
	                'Content-Type': 'application/x-www-form-urlencoded'
	            }
	        })
	        .success(function(res) {

	            if (res != 1) {
	            	$location.path("/denied");

	            }
	        })
	        .error(function() {

	        });



   socket.set();	
 

    

	    $scope.uniqueFilename = $routeParams.fileId.slice(-15);
	    $scope.wg = $routeParams.wgId;
	    $scope.templateFilename = templateName.getData().name;
	   
	        if ($scope.templateFilename == undefined) {
	      
	        $http({
	                method: 'POST',
	                url: 'backend/getFilename.php',
	                data: "fid=" + $scope.uniqueFilename, // pass in data as strings
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                }
	            })
	            .success(function(res) {

	              
	                $scope.templateFilename = res;
	            })
	            .error(function() {

	            });

	    } else {

	        $scope.templateFilename = templateName.getData().name;

	    }
	    
	    $scope.curr_colls = currentCollabs.getData("colls").colls;
	   
        function socketConnected() {

            socket.emit("documentInfo", {
                shareId: shareId,
                userId: userData.getData().userid,
                name: user
            });
        };

    socket.on("connect", socketConnected);
	    socket.on("getChangeData", getChangeData);
	        socket.on("sendUserMap", sendUserMap); // keval chat


	    $scope.$on("$destroy", function() {
	        socket.disconnect();


	    });
$scope.send_update = function(){

	   		 	 $http({
	                    method: 'POST',
	                    url: 'backend/send_update.php',
	                    data: "w=" + $routeParams.wgId + "&f="+ $scope.templateFilename, // pass in data as strings
	                    headers: {
	                        'Content-Type': 'application/x-www-form-urlencoded'
	                    }
	                })
	    };

	     function sendHighlightEmail(d) {
	    	  var dataObj = {
	                fname: $scope.templateFilename,
	                highlights:  JSON.stringify(d),
	               };
	               console.log(dataObj);

	            $http({
	                method: 'POST',
	                url: 'backend/sendHighlightEmail.php',
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                },
	                transformRequest: function(obj) {
	                    var str = [];
	                    for (var p in obj)
	                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
	                    return str.join("&");
	                },
	                data: dataObj
	            }).success(function(res) {

	                console.log(res);
	                $scope.loadingnow= false;
	                if(res == 1){

	                	 $scope.filetype_msg = {
	                    content: 'A highlight summary has been sent to your email Id',
	                    options: {
	                        ttl: 6000,
	                        type: 'success',
	                        html: true
	                    }
	                }
	                inform.add($scope.filetype_msg.content, $scope.filetype_msg.options);
	                }
	            });
	    }

	    //send highlights via email


	    $scope.sendHighlights = function() {
	    $scope.loadingnow = true;	
	    	var h_fid = $routeParams.fileId;
	    	h_fid = h_fid.slice(-15);
	    	console.log(h_fid);
	        var highlightArray = [];
	        var pullHistoryRequest = $.ajax({
	            url: "https://documendz.com/connect/pulldata/historydata/" + h_fid,
	            type: "GET",
	            cache: false,
	        });

	        pullHistoryRequest.done(function(data) {
	        	console.log(data);
	        	console.log(data.data[0].history);

	            angular.forEach(data.data[0].history, function(value, key) {
	                if (value.anno_type === "Highlight") {
	                    highlightArray.push(value.append_text);
	                }
	            });

	            if(highlightArray.length > 0){
	            sendHighlightEmail(highlightArray);

	        	}
	        	else{

	        		$scope.loadingnow= false;
	        		 $scope.errorMsg = {
	                    content: 'The document does not have any highlights',
	                    options: {
	                        ttl: 6000,
	                        type: 'danger',
	                        html: true
	                    }
	                }
	                inform.add($scope.errorMsg.content, $scope.errorMsg.options);
	        	}

	        });


	    };

	    	       $scope.publicLink = function() {
$scope.publicCreator = true;
    var b = $http({
	            method: 'POST',
	            url: 'backend/createPublicLink.php',
	            data: "fid=" + $scope.uniqueFilename, // pass in data as string
	            headers: {
	                'Content-Type': 'application/x-www-form-urlencoded'
	            }
	        });

b.success(function(data){

$scope.publicCreator = false;

	        $modal.open({
	            templateUrl: 'publicLink.html',
	            controller: 'ModalInstanceCtrl',
	            size: '',
	            resolve: {
	                data1: function() {
	                    return data;
	                }
	               
	            }

	        });

});

	    }

	    
	});




	scotchApp.controller('activityController', function($location,$rootScope,$window,Page, $scope,$routeParams,filesDataFunctions,$http) {

	
		Page.setTitle('Acivity Log - Documendz');

$window.ga('send', 'pageview', { page: "Activity" }); 
	       

 
	    $scope.fileToggle = false;   
	        $scope.wkToggle = false;   
	            // ------------ All workgroups ------------//

	            $scope.activityWg = $scope.wgData;
	             console.log($scope.wgData);
	             $scope.filenameSelected = "";
	              $scope.activityHistory = "";


	           function wkgroup_main(wid){
	            	
	                    var elementPos = $scope.activityWg.map(function(x) {
	                        return x.uniqueId;
	                    }).indexOf(wid);

	                    $scope.wgName = $scope.activityWg[elementPos].wname;

	                    $scope.wgtime =  $scope.activityWg[elementPos].time;
	                    $scope.wgAuth = {
	                    		name: $scope.activityWg[elementPos].auth_name,
	                    		id: $scope.activityWg[elementPos].auth_id	
	                    }

	                    

	             }
				// -------------files pull------------ //
	            
	            function filesPull_main(wid){
             
	            
	            $scope.a1 = $http({
	                method: 'POST',
	                url: 'backend/fetchFiles.php',
	                data: "wid=" + wid, // pass in data as string
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded'
	                }
	            });


	            $scope.a1.success(function(data) {

	                
	               
	                $scope.files_count = data.length; //files count in a particular wgroup
	               
	                var filePos = data.map(function(x) {
	                        return x.uniqueFilename;
	                    }).indexOf($routeParams.fileId);

	                    
	                $scope.filenameSelected = data[filePos].filename;
	            });


	            }


	            // -------collabs pull ---------//
	            function collabs_main(wid){
	            	
	                $http({
	                            method: 'POST',
	                            url: 'backend/fetchCollaborators.php',
	                            data: "wid=" + wid, // pass in data as strings
	                            headers: {
	                                'Content-Type': 'application/x-www-form-urlencoded'
	                            }
	                        })
	                        .success(function(data) {

	                            $scope.activityCollab = data;
	                            $scope.collabs_count = data.length;
	                       		$scope.defDp = "https://s3-ap-southeast-1.amazonaws.com/documendz-static/images/unknown_dp.jpg";


	                        });

	             }           

	            // --------anno pull -------------//

	            function anno_main(fid){

	            

				     var pullHistoryRequest = $.ajax({
	                    url: "https://documendz.com/connect/pulldata/historydata/" + fid,
	                    type: "GET",
	                    cache: false,
	                });

	                pullHistoryRequest.done(function(data) {
	            
	                    if (data.error) {

	                     
	                    } else if (data.data[0] == undefined || data.data[0].history.length == 0 ) {
	                   
	                        
	                        $scope.dt = 0;
	                        
	                    } else {
	                    	$scope.dt = 1;
	                       
	                        $scope.activityHistory = data.data[0].history;
	                       
	                    }

	                });

	                pullHistoryRequest.fail(function() {

	                   
	                });

	            }

	             // $scope.wkgroup_change = function(wid){

	             // 	wkgroup_main(wid);
	             
	             // 	collabs_main(wid);
	             // 	// filesPull_main(wid);
	             	

	             // }

	             // $scope.file_change = function(fid,filename){
	             	
	             // 	anno_main(fid);
	             	
	             // 	$scope.filenameSelected = filename;

	             // }

	            
	                wkgroup_main($routeParams.wgId);
	             	filesPull_main($routeParams.wgId);
	             	collabs_main($routeParams.wgId);
	             	anno_main($routeParams.fileId)
	             	

	});


scotchApp.controller('faqController', function($window,Page) {

		Page.setTitle('FAQs - Documendz');
		$window.ga('send', 'pageview', { page: "FAQs" }); 

	});


scotchApp.controller('logoutController',function(Page, $http,$window){

		Page.setTitle('Logout - Documendz');
		$window.ga('send', 'pageview', { page: "Logout" }); 

 $http({
	            method: 'POST',
	            url: 'backend/logout.php',
	            
	        })
	        .success(function(data) {

	         
	            $window.location.href = "https://documendz.com";


	        });


});
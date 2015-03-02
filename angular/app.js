	// create the module and name it scotchApp
	var scotchApp = angular.module('scotchApp', ['ngRoute', 'ngCookies', 'ui.bootstrap', 'helperModule', 'angularFileUpload', 'xeditable','inform']);





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

	    .when('/workgroups/sample/:wgId/:s/:fileId', {
	        templateUrl: 'sampleTemplate.html',
	        controller: 'templateController'

	    })

	      .when('/workgroups/:wgId/:fileId/activity', {
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


	scotchApp.controller('ModalInstanceCtrl', function(userData, $scope, $routeParams, $modalInstance, workGroupFunctions, $http, commonFunctions, collaboratorFunctions) {
	    $scope.newProj = {};
	    $scope.newCollab = {};

	    $scope.cancel = function() {

	        $modalInstance.close();
	    };

	    $scope.saveProject = function() {
	        $scope.newProj['rnd'] = commonFunctions.random_string();

	        console.log($scope.newProj + "kd");
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

	        $scope.newCollab.email = ""; // Empty the input field
	        $modalInstance.close();
	    };


	});


	scotchApp.controller('mainController', function(Page, inform,$modal, userData, $window, workGroupFunctions, $scope, $routeParams, $http, $rootScope, userData, $location,$filter) {

	    // 	console.log(userData.getData());
	    // 	userData.setData('Vipul', 'name');
	    // console.log(userData.getData());
	    // userData.setData('14','age');
	    // console.log(userData.getData());

  $http.get("backend/checkLoggedIn.php")
	        .success(function(res) {

	            if (res != 1) {
	            	alert("res " + res);

	                $window.location.href = "https://www.documendz.com";

	            }
	        })
	        .error(function() {

	        });



 $scope.inform = inform;
  $scope.Page = Page;
Page.setTitle('Workgroups - Documendz');

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
	        
	    };

$scope.emToggle = false;  //is-open="emToggle"
$scope.fiToggle = false;

	  



	    $http.get("backend/fetch.php")
	        .success(function(data) {

	            userData.setData(data[0].userid, 'userid');


	            $scope.userData = data;
	            $scope.pt = data[0].userid;
	            $scope.ut = data[0].username;
	               $scope.flimit = data[0].files;
	            $scope.wlimit = data[0].workgroups;
	            $scope.climit = data[0].collaborators;
	            console.log(userData.getData());


	        })
	        .error(function() {
	            $scope.data = "error in fetching data";
	        });


	    $http.get("backend/fetch_workgroups.php")
	        .success(function(data) {

          if(!data['wg']){
                $scope.workgroupParams.count = 0;
                $scope.myWorkgroupCount = 0;
                $scope.wgData = [];
         		alert("workgroup blank");
         }
         else{
	            $scope.wgData = data['wg'];
	            $scope.emData = data['emails'];
	            $scope.workgroupParams.count = data['wg'].length;

	            $scope.myWorkgroupCount = $filter('filter')($scope.wgData,{auth_id : userData.getData().userid}).length;
	            

	            console.log( "wgdata: " + $scope.wgData);

	            console.log("Total workgroups: " + $scope.workgroupParams.count);
	          }
	        })
	        .error(function() {
	            //error
	        });




	    $scope.addWorkgGroup = function() {

	        if ($scope.myWorkgroupCount < $scope.wlimit) {

	            $modal.open({
	                templateUrl: 'myModalContent.html',
	                controller: 'ModalInstanceCtrl',
	                size: '',
	            });

	        } else if ($scope.myWorkgroupCount >= $scope.wlimit) {
	            $modal.open({
	                templateUrl: 'limitReached.html',
	                controller: 'ModalInstanceCtrl',
	                size: '',
	            });
	        }

	    }


	    $http.get("backend/fetch.php")
	        .success(function(data) {

	            userData.setData(data[0].userid, 'userid');


	            $scope.userData = data;
	            $scope.pt = data[0].userid;


	        })
	        .error(function() {
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
	        console.log($scope.workgroupParams.count);

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
	        console.log($scope.wgData);
	        
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
	        });


	    };

	});



	scotchApp.controller('accountController', function(Page, $scope, userData, $http) {
		
		Page.setTitle('Account Details - Documendz');

		$scope.accountInfo = {
				Username: $scope.userData[0].username,
	            Email: $scope.userData[0].emailid,
	            StartDate: $scope.userData[0].start

		};
	    
	    
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

	                    alert(res);
	                    $scope.abc.oldPass = "";
	                    $scope.abc.newPass = "";

	                })

	    };

 // ---------- pull old files --------------  //

       $http({
	                    method: 'POST',
	                    url: 'backend/fetchOldFiles.php',
	                    headers: {
	                        'Content-Type': 'application/x-www-form-urlencoded'
	                    }
	                })
	                .success(function(res) {

	                	$scope.oldFiles = res;

	                })

	});



	scotchApp.controller('filesController', function(templateName, Page, filesDataFunctions,$scope,$rootScope, $http, $routeParams, userData,$modal,$upload, $cookies, $timeout,$location,inform) {

// check permissions to the wkgroup: either the author or is a collab
	    	    Page.setTitle('Files - Documendz');

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
	            console.log(data);
	            
	            
	            
	            // $scope.isDisabled = ($scope.allFiles.length >= 4) ? "true" : "false";
				
				

	        });



	            

	    // fetch collaborators

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


	        });

	    $scope.$on('updateCollaborators', function(event, data) {
	        //push into scope for collabData

	        $scope.collabData.push(data);

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

	                alert("done");

	            })

	    };


	    $scope.deletefile = function(file_unique,file_ext,s) {

	        var elementPos = $scope.allFiles.map(function(x) {
	            return x.uniqueFilename;
	        }).indexOf(file_unique);
	        var objectFound = $scope.allFiles[elementPos];
	        var idx = $scope.allFiles.indexOf(objectFound);
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



	            // })

	    };




	    $scope.inviteCollab = function() {

if ($scope.wkgroupAuthId == $scope.pt){

	        if($scope.collabData.length >= $scope.climit){

	        $modal.open({
	            templateUrl: 'collabLimitReached.html',
	            controller: 'ModalInstanceCtrl',
	            size: '',
	        });
	        
	        }
	        else{
				
			$modal.open({
	            templateUrl: 'invite.html',
	            controller: 'ModalInstanceCtrl',
	            size: '',
	        });


	        }
}

else{

console.log("hello");

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

        $http.get('https://s3-ap-southeast-1.amazonaws.com/docs-ent/uploaded/user_'+userData.getData().userid+'/thumbnails/'+$scope.n+'.jpg')
    .success(function (data, status, headers, config) {
        $scope.tr = 1;
    }).error(function (data, status, headers, config) {
        console.log("naah");
        poll($scope.n);
        
});
            
        }, 3500);
    };

	  
	      	    $scope.uploadFile = function(file) {
	        $scope.showProgress = 0;
	        $scope.progressValue = 0;
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
	                }).success(function(data, status, headers, config) {
	                    // file is uploaded successfully
	                    console.log('file is uploaded successfully. Response: ' + data);
	                    $scope.stopSpin = 1;
	                    $scope.fileName = "";

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
	                        console.log($scope.allFiles);
	                        //$scope.run = data;
	                        poll(data);
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

	 	alert("kjuerhve");
	 	
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


	scotchApp.controller('templateController', function(templateName, Page, $scope,usables,socket,$routeParams,$rootScope,$route,$location,$http) {
		Page.setTitle('Document - Documendz');

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

        function socketConnected() {

            socket.emit("documentInfo", {
                shareId: shareId,
                userId: userId,
                name: user
            });
        };

    socket.on("connect", socketConnected);
	    socket.on("getChangeData", getChangeData);
	    console.log(socket);



	   


	    $scope.$on("$destroy", function() {
	        socket.disconnect();

	        console.log(socket);

	    });
	});




	scotchApp.controller('activityController', function(Page, $scope,$routeParams,filesDataFunctions,$http) {

		Page.setTitle('Acivity Log - Documendz');

$scope.selFile = $routeParams.fileId;
			// console.log($scope.wgData); //works


function changeFile(ufilename){
	$scope.noData = 0;
$scope.activityWg = $scope.wgData;		
filesDataFunctions.get().then(function(promise){

 console.log(promise.data);

$scope.activityFiles = promise.data;

  var elementPos = $scope.activityFiles.map(function(x) {
	            return x.uniqueFilename;
	        }).indexOf($scope.selFile);

  var i = $scope.activityFiles[elementPos].workgroupid;

   $http({
	            method: 'POST',
	            url: 'backend/fetchCollaborators.php',
	            data: "wid=" + i, // pass in data as strings
	            headers: {
	                'Content-Type': 'application/x-www-form-urlencoded'
	            }
	        })
	        .success(function(data) {

	            $scope.activityCollab = data;
	            console.log(data);


	        });


});
	

 var pullHistoryRequest = $.ajax({
                url: "https://documendz.com:9000/pulldata/historydata/"+ $scope.selFile,
                type: "GET",
                cache: false,
            });

            pullHistoryRequest.done(function(data) {
                if (data.error) {

                    console.log("Server Error Pulling data")
                } else if (data.data.length === 0) {
                    console.log("No Data");
                    $scope.activityHistory = "";
                    $scope.noData = 1;
                } else {

                	console.log(data.data[0].history);
                  $scope.activityHistory = data.data[0].history;
                }

            });

            pullHistoryRequest.fail(function() {

                console.log("Error Pulling History");
            });
}
$scope.selectionFile = function(ufilename){

	$scope.selFile = ufilename;
		changeFile($scope.selFile);
}
   
changeFile($scope.selFile);

	});


scotchApp.controller('faqController', function(Page) {

		Page.setTitle('FAQs - Documendz');

	});


scotchApp.controller('logoutController',function(Page, $http,$window){

		Page.setTitle('Logout - Documendz');

 $http({
	            method: 'POST',
	            url: 'backend/logout.php',
	            
	        })
	        .success(function(data) {

	         
	            $window.location.href = "https://documendz.com";


	        });


});
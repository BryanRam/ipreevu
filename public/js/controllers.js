/**
 * @memberof starter
 * @ngdoc module
 * @name starter.controllers
 * 
 * 
 * 
 */

angular.module('starter.controllers', [])
 .constant("googleMapsUrl", "https://maps.googleapis.com/maps/api/js?key=AIzaSyCHFeZmCq350xL4BAMgH4WA9LboR2vlWmo")
 .controller('TestCtrl', function($scope){
     $scope.sliderWithArrowOptions = {
                        name: "sliderWithArrow",
                        $DragOrientation: 3,                            //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                        $SlideDuration: 800,                            //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                        $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                            $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                            $ChanceToShow: 2,                           //[Required] 0 Never, 1 Mouse Over, 2 Always
                            $AutoCenter: 2,                             //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                            $Steps: 1                                   //[Optional] Steps to go for each navigation request, default value is 1
                        }
                    };
})

/**
 * @memberof starter
 * @ngdoc controller
 * @desc Controller for the 'main' parent state
 * @name MainCtrl
 * @param Attendee {service} factory service that holds all attendee-specific services for the conference
 * @param $location {service} ng location
 * @returns {undefined}
 */
.controller('MainCtrl', function(Attendee, Web, $location, $scope) {
//        console.log($localStorage);
        CheckIfLoggedIn(Attendee, $location);
        $scope.$on('$stateChangeSuccess', function(){
            console.log("State change success");
           CheckIfLoggedIn(Attendee, $location); 
        });

		//CheckIfJoined(Attendee, Web);

})


/**
 * @memberof starter
 * @ngdoc controller
 * @desc Controller for the 'main-home' view in the 'main.home' state
 * @name HomeCtrl
 * @param $scope {service} controller scope
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @param $localstorage {service} ngStorage localStorage
 * @param $location {service} ng location
 * @param $http {service} promise http
 * @returns {undefined}
 */
.controller('HomeCtrl', function($scope, Web, Attendee, $localStorage, $location) {
//        console.log($localStorage);
//        CheckIfLoggedIn(Attendee, $location);
	$scope.bgImage = 'img/backgrounds/4.jpg';

	var presentations = [];
	$scope.presentation = [];

	$scope.submitSpeaker = function() {
		$scope.loading = true;

		Web.Speakers.Create($scope.speakerData)
			.then(function(response) {
					alert('Speaker added!');
					Web.Speakers.List()
						.success(function(data) {
							$scope.speakers = data;
							$scope.loading = false;
						});
				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);

	};

	$scope.loading = true;

	Web.Speakers.List()
		.success(function(data) {
			$scope.speakers = data;
			$scope.loading = false;
			// alert('Reached here with ' + $scope.speakers);
		});

	$scope.deleteSpeaker = function(id) {
		Web.Speakers.Delete(id, function(response) {
			alert("Speaker deleted");
			Web.Speakers.List()
				.success(function(data) {
					$scope.speakers = data;
				});
		}, function(response) {
			alert("Error!!!");
		});
	};

	$scope.loading = true;

// Commented out Attendee.Conferences, which selects conferences which the attendee has already joined
//	Attendee.Conferences()
//		.success(function(data) {
//			$scope.conferences = data;
//			$scope.loading = false;
//			//           // alert('Reached here with ' + $scope.speakers);
//			angular.forEach(data, function(value, key) {
//                                
//				Web.Conferences.Presentation(value.conference_id).success(function(data) {
//					
//                                        $scope.presentation[value.conference_id] = data;
//
//				});
//				//        }
//
//			});
//		});

        //Displays all the public conferences
        Web.Conferences.List()
		.success(function(data) {
			$scope.conferences = data;
			$scope.loading = false;
			//           // alert('Reached here with ' + $scope.speakers);
			angular.forEach(data, function(value, key) {
                                
				Web.Conferences.Presentation(value.conference_id).success(function(data) {
					
                                        $scope.presentation[value.conference_id] = data;

				});
				//        }

			});
		});

	$scope.loading = true;

	$scope.selectPres = function(id) {
		$scope.loading = false;
		console.log(presentations[id].$$state.value.data);

		return presentations[id].$$state.value.data;
	};

	$scope.logout = function() {
		// remove user from local storage and clear http auth header
		Attendee.logout();
		delete $localStorage.currentUser;
		//$http.defaults.headers.common.Authorization = '';
		$location.path('/login');
	};
        
        $scope.joinConference = function(conference_id) {
            alert('Joining Conference...');
            //allows user to be added to a public conference
            Attendee.JoinConference(conference_id);
			//var res = Web.Conferences.JoinConference(conference_id);
			alert("Conference joined!");
			console.log(res);
        }
	
	$scope.checkIfJoined = function(conference_id){
		return CheckIfJoined(conference_id, $scope.userConferences);
	}

	Attendee.Conferences()
	.success(function(data) {
	$scope.userConferences = data;
	
    });

	

	$scope.leaveConference = function(conference_id){
		Attendee.LeaveConference(conference_id,	function(response) {
			alert("Left Conference");
			Web.Attendees.Conferences()
				.success(function(data) {
					$scope.userConferences = data;
				});
		}, function(response) {
			alert("Error!!!");
		});
	}
})

.controller('bgCtrl', function($scope) {
	$scope.bgImage = 'img/backgrounds/3.jpg';
})

/**
 * @memberOf starter
 * @ngdoc controller
 * @name HeaderCtrl
 * @desc Controller for the 'header' view, used in multiple states.
 * @param $scope {service} controller scope
 * @param Attendee {service} factory service that holds all the table-specific services for the conference
 * @param $localstorage {service} ngStorage localStorage
 * @param $location {service} ng location
 * @returns {undefined}
 */
.controller('HeaderCtrl', function($scope, Attendee, $location, $localStorage, $stateParams, Web) {
    
        $scope.menuToggle = false;
		$scope.helpModal = false;
        $scope.select = function () {
                $scope.menuToggle = !$scope.menuToggle;
            };
    
	$scope.userDetails = $localStorage.user_data;
        
        Attendee.Conferences()
		.success(function(data) {
			$scope.conferences = data;
			
                    });
                    
        Web.Conferences.Select($stateParams.conferenceID)
                .success(function(data) {
                    $scope.conference = data;
                   });

	$scope.logout = function() {
		// remove user from local storage and clear http auth header
		Attendee.Logout();
		// delete $localStorage.currentUser;
		//$http.defaults.headers.common.Authorization = '';
		$location.path('/login');
	};

	$scope.showHelpModal = function($scope) {
		console.log("is here.");
	console.log($scope);
		$scope.helpModal = true;
	};
})

.controller('AboutCtrl', function($scope, $stateParams, Web) {
    Web.Conferences.Select($stateParams.conferenceID)
                .success(function(data) {
                    $scope.conference = data;
                });
})

/**
 * @memberOf starter
 * @ngdoc controller
 * @name SelectCtrl
 * @desc Controller for the 'main-home' view in the 'main.home-presentations' state
 * @param $scope {service} controller scope
 * @param $stateParams {service} Parameters added to the state's url
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @returns {undefined}
 */
.controller('SelectCtrl', function($scope, $stateParams, Web) {
	Web.Speakers.Select($stateParams.speakerID).success(function(data) {
		$scope.speaker = data;

	});
})

/**
 * @memberOf starter
 * @ngdoc controller
 * @name SpeakersCtrl
 * @desc Controller for the 'main-home' view in the 'main.home-speakers' state
 * @param $scope {service} controller scope
 * @param $stateParams {service} Parameters added to the state's url
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @returns {undefined}
 */
.controller('SpeakersCtrl', function($scope, $stateParams, Web) {
        Web.Conferences.Select($stateParams.conferenceID)
                .success(function(data) {
                    $scope.conference = data;
                   });
        
	Web.Speakers.List().success(function(data) {
		$scope.speakers = data;

	});
})


/**
 * @memberof starter
 * @ngdoc controller
 * @name ConfCtrl
 * @param $scope {service} controller scope
 * @param $stateParams {service} Parameters added to the state's url
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @returns {undefined}
 */
.controller('ConfCtrl', function($scope, $stateParams, Web) {
	Web.Conferences.Select($stateParams.conferenceID).success(function(data) {
		$scope.conference = data;

	});

	Web.Conferences.Presentations($stateParams.conferenceID).success(function(data) {
		$scope.presentations = data;
                //console.log($scope.presentations);
	});

	// TODO: Review the function/operation below.
	Web.Speakers.Conferences($stateParams.conferenceID).success(function(data) {
		$scope.speakers = data;
	});

	$scope.deleteSpeaker = function(id) {
		Web.Speakers.Delete(id, function(response) {
			alert("Speaker deleted");
			Web.Speakers.Conferences($stateParams.conferenceID)
				.success(function(data) {
					$scope.speakers = data;
				});
		}, function(response) {
			alert("Error!!!");
		});
	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name LoginCtrl
 * @param $scope {service} controller scope
 * @param {type} Attendee factory service that holds all the table-specific services for the conference
 * @param {type} $location
 * @param {type} $routeParams Query Parameters
 * @param {type} $localStorage ngStorage localStorage
 * @returns {undefined}
 */
.controller('LoginCtrl', function($scope, Attendee, $location, $localStorage) {
	if (Attendee.CheckIfLoggedIn())
		$location.path('/main/home');

	$scope.bgImage = 'img/backgrounds/3.jpg';

	$scope.loginAttendee = function() {
		$scope.loading = true;
                
		Attendee.Login($scope.attendeeData.email, $scope.attendeeData.password, $scope.attendeeData.remember)
			.then(function(response) {
					console.log('Login Successful!');

					$scope.loading = false;
					///*
					// Store username and token in local storage to keep user logged in between page refreshes
					$localStorage.currentUser = {
						username: response.data.user.name,
						token: response.data.token,
						id: response.data.user.attendee_id
					};
					//*/

					// add jwt token to auth header for all requests made by the $http service
					$location.path('/main/home');
				},
				function(response) {
					console.log('Something went wrong with the login process. Try again later!');
				}
			);

	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name LoginClientCtrl
 * @param {type} $scope controller scope
 * @param {type} Web factory service that holds all the table-specific services for the conference
 * @param {type} $location
 * @param {type} $http promise http
 * @param {type} $localStorage ngStorage localStorage
 * @returns {undefined}
 */
.controller('LoginClientCtrl', function($scope, Web, $location, $http, $localStorage) {
	$scope.loginClient = function() {

		$scope.loading = true;

		Web.Clients.Login($scope.clientData)
			.then(function(response) {
					alert('Login Successful! ' + response.data.user.contact_name);
					$scope.loading = false;
					//console.log(response.data);
					//console.log(response.data.user);
					// store username and token in local storage to keep user logged in between page refreshes
					$localStorage.currentUser = {
						username: response.data.user.contact_name,
						token: response.data.token
					};

					// add jwt token to auth header for all requests made by the $http service

					$http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
					$location.path('/client/profile');

				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);

	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name RegCtrl
 * @param $scope {service} controller scope
 * @param {type} Web factory service that holds all the table-specific services for the conference
 * @param {type} $location
 * @returns {undefined}
 */
.controller('RegCtrl', function($scope, Web, $location) {
        console.log($scope);
	$scope.bgImage = 'img/backgrounds/3.jpg';

	$scope.submitAttendee = function() {
                console.log($scope);
		$scope.loading = true;

		if ($scope.attendeeData.password !== $scope.pword) {
			alert("passwords don't match!");
			return;
		}

		Web.Attendees.Register($scope.attendeeData)
			.then(function(response) {
					alert('Attendee added!');
					$location.path('/login').search({
						email: $scope.attendeeData.email
					});

				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);
	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name RegClientCtrl
 * @param $scope {service} controller scope
 * @param {type} Web
 * @param {type} $location
 * @returns {undefined}
 */
.controller('RegClientCtrl', function($scope, Web, $location) {
	$scope.submitClient = function() {

		$scope.loading = true;

		if ($scope.clientData.password !== $scope.pword) {
			alert("passwords don't match!");
			return;
		}

		Web.Clients.Register($scope.clientData)
			.then(function(response) {
					alert('Client added!');
					$location.path('/client/login');

				},
				function(response) {
					alert('Something went wrong with the registration process. Try again later!');
				}
			);
	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name ForgotPassCtrl
 * @param $scope {service} controller scope
 * @param {type} Web
 * @param {type} $location
 * @returns {undefined}
 */
.controller('ForgotPassCtrl', function($scope, Web, $location) {
        $scope.bgImage = 'img/backgrounds/3.jpg';
        
	$scope.sendEmail = function() {
                console.log($scope);
		$scope.loading = true;

		Web.Attendees.ForgotPassword($scope.email)
			.then(function(response) {
					alert('Email Sent!');
				},
				function(response) {
					alert('Email was unsuccessful.');
				}
			);

		$scope.location = false;
	};

})

/**
 * @memberof starter
 * @ngdoc controller
 * @name ResetPassCtrl
 * @param $scope {service} controller scope
 * @param {type} $stateParams
 * @param {type} Attendee
 * @returns {undefined}
 */
.controller('ResetPassCtrl', function($scope, $stateParams, Web) {
        $scope.bgImage = 'img/backgrounds/3.jpg';
	$scope.sendEmail = function() {
		$scope.loading = true;
		$scope.attendeeData.token = $stateParams.token;
		$scope.attendeeData.email = $stateParams.email;
		console.log($stateParams);

		Web.Attendees.ResetPassword($scope.attendeeData)
			.then(function(response) {
					alert('Password successfully reset!');
				},
				function(response) {
					alert('Password reset unsuccessful.');
				}
			);

		$scope.location = false;
	}
})

.controller('ChangePassCtrl', function($scope, $stateParams, Web){
        
        $scope.changePassword = function (){
            
            
            if ($scope.attendeeData.password !== $scope.pword) {
			alert("passwords don't match!");
			return;
		}
        }
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name MapCtrl
 * @param $scope {service} controller scope
 * @param NgMap {service} NgMap
 * @param googleMapsUrl {constant} url and api key for a Google Map
 * @returns {undefined}
 */
.controller('MapCtrl', function($scope, NgMap, googleMapsUrl){
    $scope.googleMapsUrl = googleMapsUrl;
    NgMap.getMap().then(function(map) {
    console.log(map.getCenter());
    console.log('markers', map.markers);
    console.log('shapes', map.shapes);
  });
    
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name UserCtrl
 * @param $scope {service} controller scope
 * @param NgMap {service} NgMap
 * @param googleMapsUrl {constant} url and api key for a Google Map
 * @returns {undefined}
 */
.controller('UserCtrl', function($scope, $localStorage){
    $scope.attendee = $localStorage.user_data;
    console.log($scope.attendee.name);
    
});

//.controller('MainCtrl', function($scope) {})
//
//.controller('AccountCtrl', function($scope) {
//	$scope.settings = {
//		enableFriends: true
//	};
//});

/**
 * Checks if the user is logged in, redirects them to the login page if they are not
 * @param {type} Attendee
 * @param {type} $location
 * @returns {void}
 */
function CheckIfLoggedIn(Attendee, $location)
{
//    var resultz = Attendee.CheckIfLoggedIn();
//    var result = Attendee.IsLogged();
//    console.log("resultz= " + resultz);
//    console.log(result);
    if (!Attendee.CheckIfLoggedIn())
           $location.path('/login');
}

function CheckIfJoined(conferenceID, userConferences){
	let cid = conferenceID;
	let userConfs = userConferences;

	

	userConfs.forEach((uconf) => {
		
		if(cid === uconf.conference_id)
		{
			console.log("Check if joined T");
			return true;
		}

	});

	//return false;
}


/*
//POPUP CONTROLLER FOR HELP AND REPORT BUG
.controller('ModalCtrl', function($scope, $uibModal, $log) {
    $scope.animationsEnabled = true;

    $scope.items = ['item1', 'item2', 'item3'];

     $scope.open = function (size) {

    var modalInstance = $uibModal.open({   //to be edited 
      animation: $scope.animationsEnabled,
      templateUrl: 'myModalContent.html',
      controller: 'ModalInstanceCtrl',
      size: size,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });
    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());  //logs change
    });
  };

  $scope.toggleAnimation = function () {
    $scope.animationsEnabled = !$scope.animationsEnabled;  //for toggling animation.
  };

})

.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items) {

  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };

  $scope.ok = function () {
    $uibModalInstance.close($scope.selected.item); //passes selected item. can be used for conference_id selections
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});*/
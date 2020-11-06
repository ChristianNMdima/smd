app.controller("home_controller", function($scope, httpService, validation_service) {

    console.log("* Home Page");

    $scope.user = {};
    $scope.users = [];
    $scope.user.gender = 'male';
    $scope.gender = false;
    $scope.age = false;
    $scope.dob = false;
    $scope.car_make = false;
    $scope.car_colour = false;
    $scope.formValid = false;

    $scope.getData = function() {
        $scope.users = httpService.call('get', 'backend/user/read.php', '');
    }

    $scope.saveData = function() {
        console.log(httpService.call('post', 'backend/user/create.php', $scope.user));
        $scope.getData();
        $scope.getData();
    }

    $scope.validate = function() {
        $scope.formValid = validation_service.validate($scope.user);
    }

});
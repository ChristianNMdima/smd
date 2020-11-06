var app = angular.module("app", ['ui.router', 'angularMoment']);

console.log('* App started!');

app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/');
    $stateProvider.state('/', {
        url: '/',
        templateUrl: 'app/view/home/home.html',
        controller: 'home_controller'
    });
    $stateProvider.state('home', {
        url: '/home',
        templateUrl: 'app/view/home/home.html',
        controller: 'home_controller'
    });
    $stateProvider.state('users', {
        url: '/users',
        templateUrl: 'app/view/users/users.html',
        controller: 'users_controller'
    });

});
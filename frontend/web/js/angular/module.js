 var app = angular.module('va', ['ngAnimate']);
 app.controller('vaCntrl', function ($scope, $http) {

     $scope.info = function () {
        $scope.errorMessage = false;
         $http.post('/core', {
             do: 'info',
             urls: $scope.urls,
         }).then(
             function (resp) {
                 $scope.total_size = resp.data.total_size;
                 $scope.total_coef_size = resp.data.total_coef_size;
                 $scope.total_discount = resp.data.total_discount;

             },
             function (error) {
                 $scope.errorMessage = error.data.message;
                 $scope.total_size = false;
                 console.log($scope.errorMessage);
             });

     }

     var check = function () {

     }
 });
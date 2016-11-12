/**
 * Created by DNOJ on 6/8/2016.
 */
'use strict';

angular.module('kanban').controller('MoveBackCardController',
    ['$scope', '$modalInstance', 'card', '$http','$route', function ($scope, $modalInstance, card, $http,$route) {

        function initScope(card) {
            $scope.cardID = card.cardID;
            $scope.before = card.before;
            $scope.after = card.after;
        }

        initScope(card);
      
        
        $scope.commentMoveBack = function (comment) {
            var $addCom = {
                detail : comment,
                before : $scope.before,
                after : $scope.after
            };
            $http({
                method: 'POST',
                url: '/kanban/commentMoveBack/' + $scope.cardID,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data : $.param($addCom)
            }).success(function (r) {
                $route.reload();
                $modalInstance.close();
            })
        };

        $scope.commentMoveAllBack = function (comment) {
            var $addCom = {
                detail : comment,
                before : $scope.before,
                after : $scope.after
            };
            $http({
                method: 'POST',
                url: '/kanban/commentMoveAllBack/' + $scope.cardID,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data : $.param($addCom)
            }).success(function (r) {
                $route.reload();
                $modalInstance.close();

            })
        };

        
    }]);
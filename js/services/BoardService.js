/*jshint undef: false, unused: false, indent: 2*/
/*global angular: false */

'use strict';

angular.module('kanban').service('BoardService', ['$modal', 'BoardManipulator', '$http', function ($modal, BoardManipulator, $http, $scope, CSRF_TOKEN) {

    return {

        kanbanBoard: function (board) {

            var kanbanBoard = new Board(board.name, board.numberOfColumns);
            angular.forEach(board.columns, function (column) {
                BoardManipulator.addColumn(kanbanBoard, column.name);
                angular.forEach(column.cards, function (card) {
                    BoardManipulator.addCardToColumn(kanbanBoard, column, card);
                    //console.log(card)
                });
            });
            return kanbanBoard;
        },

        cardMove: function ($MoveEvent) {

            return $http({
                //crossDomain : true,
                method: 'POST',
                url: '/kanban/moveCard',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $.param($MoveEvent)
            }).success(function (r) {
            });
        },

        removeCard: function (board, column, card) {

            if (confirm('Are You sure to Delete?')) {
                var $DeCard = {
                    card: card.id
                };

                return $http({
                    method: 'POST',
                    url: '/kanban/removeCard',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param($DeCard)
                }).success(function (t) {

                    BoardManipulator.removeCardFromColumn(board, column, card);
                }).error(function () {
                    $modal.open({
                        templateUrl: '/kanban/views/partials/errorDel.html'
                    });
                });
            }
        },


        detailCard: function (card) {
            var show = $modal.open({
                templateUrl: '/kanban/views/partials/detailCard.html',
                controller: 'DetailCardController',
                backdrop: 'static',
                resolve: {
                    card: function () {

                        var $cardId = {
                            cardId: card.id
                        };

                        return $http({
                            method: 'POST',
                            url: "/kanban/getOneCard",
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            data: $.param($cardId)
                        })

                    }
                }
            });
        },
        afterMove: function (beforeStatus,afterStatus) {
            var show = $modal.open({
                templateUrl: '/kanban/views/partials/afterMove.html',
                controller: 'MoveCardController',

                resolve: {
                    statusMove: function () {

                        var $status = {
                            before: beforeStatus,
                            after: afterStatus

                        };
                        return $status;
                    }
                }

            });
        },
        afterMoveBack: function (cardID,beforeStatus,afterStatus) {

            var show = $modal.open({
                templateUrl: '/kanban/views/partials/afterMoveBack.html',
                controller: 'MoveBackCardController',
                backdrop: 'static',
                resolve: {
                    card: function () {

                        var $data = {
                            cardID:cardID,
                            before: beforeStatus,
                            after: afterStatus
                        }

                        return $data;

                    }
                }
            });

        },
        boardComplete: function () {
            var show = $modal.open({
                templateUrl: '/kanban/views/partials/boardComplete.html',
                controller: 'BoardCompleteController',
                backdrop: 'static'

            });
        },
        boardInComplete: function () {
            var show = $modal.open({
                templateUrl: '/kanban/views/partials/boardInComplete.html',
                controller: 'BoardCompleteController',
                backdrop: 'static'

            });
        }



    };
}]);

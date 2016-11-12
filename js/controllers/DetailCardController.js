/**
 * Created by DNOJ on 3/24/2016.
 */

'use strict';

angular.module('kanban').controller('DetailCardController',
    ['$scope', '$modalInstance', 'card', '$http','$route','$timeout',
        function ($scope, $modalInstance, card, $http,$route,$timeout) {


        //console.log(card)
        /* กำหนดค่า */
        function initScope(card) {
            $scope.cardData = [];
            $scope.cardData = card.data;
            $scope.saveSuccess = 0;
        }

        function getDataCard(){
            $http({
                method: 'POST',
                url : "/kanban/getCardEditData",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}

            }).success(function (r) {

                $scope.DataEdit = r;

               // console.log($scope.DataEdit)

            })
        }


        $scope.close = function () {
            $route.reload();
            $modalInstance.close();

        };

        initScope(card);
        getDataCard();


        $scope.detailCard = function () {
            var buffer = [];
            if (!this.newCardForm.$valid) {
                return false;
            }

            /* $modalInstance.close({title: this.title, column: card, details: this.details
             ,estimateStart: this.estimateStart,estimateEnd: this.estimateEnd});*/
        };


            $scope.getPriority = function (level) {

                if (level == 1) {
                    return "Normal";
                }else if (level == 2){
                    return "High";
                }

                /* $modalInstance.close({title: this.title, column: card, details: this.details
                 ,estimateStart: this.estimateStart,estimateEnd: this.estimateEnd});*/
            };

       /* edit card */
        $scope.saveEditCard = function (cardData) {
            $http({
                method: 'POST',
                url: '/kanban/editCard/' + cardData.id,
                data : cardData
            }).success(function (r) {
                //console.log(r);

                if(r.status_id == 1){
                    r.status = "Backlog"
                }else if(r.status_id == 2){
                    r.status = "Ready"
                }else if(r.status_id == 3){
                    r.status = "Doing"
                }else if(r.status_id == 4){
                    r.status = "Done"
                }
                $scope.cardData = r;
                card = $scope.cardData;
                $scope.saveSuccess = 1;
                $timeout(function() {
                    $scope.saveSuccess = 0;

                }, 3000);
            })
        };

        /* ---------------------------------------------------------------------- Checklist */

        $scope.addChecklist = function (addchecklist,cardID) {

            var $addCheck = {
                name : addchecklist
            };
            $http({
                method: 'POST',
                url: '/kanban/addNewChecklist/'+ cardID,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data : $.param($addCheck)
            }).success(function (r) {

                if(r.status_id == 1){
                    r.status = "Backlog"
                }else if(r.status_id == 2){
                    r.status = "Ready"
                }else if(r.status_id == 3){
                    r.status = "Doing"
                }else if(r.status_id == 4){
                    r.status = "Done"
                }

                $scope.cardData = r;

                $scope.newChecklist = "";
            });

        };

        $scope.changeCheckStatus = function (checklist) {

            $http({
                method: 'POST',
                url: '/kanban/changeCheckStatus/' + checklist.id,
                data : checklist
            }).success(function (r) {

                if(r.status_id == 1){
                    r.status = "Backlog"
                }else if(r.status_id == 2){
                    r.status = "Ready"
                }else if(r.status_id == 3){
                    r.status = "Doing"
                }else if(r.status_id == 4){
                    r.status = "Done"
                }
                $scope.cardData = r;
                card = $scope.cardData;
            });

        };

        $scope.updateChecklist = function (checklist) {
            $http({
                method: 'POST',
                url: '/kanban/updateChecklist/' + checklist.id,
                data : checklist
            }).success(function (r) {

                if(r.status_id == 1){
                    r.status = "Backlog"
                }else if(r.status_id == 2){
                    r.status = "Ready"
                }else if(r.status_id == 3){
                    r.status = "Doing"
                }else if(r.status_id == 4){
                    r.status = "Done"
                }
                $scope.cardData = r;
                card = $scope.cardData;
            });
        };

        $scope.removeChecklist = function (cardID,checklistID) {
            if (confirm('Are You sure to Delete Checklist?')) {
                $http({
                    method: 'POST',
                    url: '/kanban/removeChecklist/' + cardID + '/' + checklistID

                }).success(function (r) {

                    if (r.status_id == 1) {
                        r.status = "Backlog"
                    } else if (r.status_id == 2) {
                        r.status = "Ready"
                    } else if (r.status_id == 3) {
                        r.status = "Doing"
                    } else if (r.status_id == 4) {
                        r.status = "Done"
                    }
                    $scope.cardData = r;

                });
            }
        };


        //--------------------------------------------------------------------------------Comment
        $scope.addComment = function (addcomment,cardID) {

            var $addCom = {
                detail : addcomment
            };
            $http({
                method: 'POST',
                url: '/kanban/addNewComment/'+ cardID,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data : $.param($addCom)
            }).success(function (r) {

                if(r.status_id == 1){
                    r.status = "Backlog"
                }else if(r.status_id == 2){
                    r.status = "Ready"
                }else if(r.status_id == 3){
                    r.status = "Doing"
                }else if(r.status_id == 4){
                    r.status = "Done"
                }
                $scope.cardData = r;

                $scope.newComment = "";
            });

        };

            // UPDATE COMMENT
            $scope.updateComment = function (comment) {
                $http({
                    method: 'POST',
                    url: '/kanban/updateComment/' + comment.id,
                    data : comment
                }).success(function (r) {

                    if(r.status_id == 1){
                        r.status = "Backlog"
                    }else if(r.status_id == 2){
                        r.status = "Ready"
                    }else if(r.status_id == 3){
                        r.status = "Doing"
                    }else if(r.status_id == 4){
                        r.status = "Done"
                    }
                    $scope.cardData = r;
                    card = $scope.cardData;
                });
            };

        $scope.removeComment = function (commentID,cardID) {
            if (confirm('Are You sure to Delete Comment?')) {
                $http({
                    method: 'POST',
                    url: '/kanban/removeComment/' + commentID +'/'+cardID

                }).success(function (r) {

                       if (r.status_id == 1) {
                     r.status = "Backlog"
                     } else if (r.status_id == 2) {
                     r.status = "Ready"
                     } else if (r.status_id == 3) {
                     r.status = "Doing"
                     } else if (r.status_id == 4) {
                     r.status = "Done"
                     }
                     $scope.cardData = r;
                     card = $scope.cardData;
                });
            }
        };





    }]);

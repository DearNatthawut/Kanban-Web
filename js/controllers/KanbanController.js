/*jshint undef: false, unused: false, indent: 2*/
/*global angular: false */
'use strict';

angular.module('kanban').controller('KanbanController', ['$scope', 'BoardService', 'BoardDataFactory', '$http',

    function ($scope, BoardService, BoardDataFactory, $http) {


        var self = this;
        self.date = new Date();

        self.checkComplete = 0;


        function getDataMember() {
            $http({
                method: 'POST',
                url: "/kanban/getDataMember",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}

            }).success(function (r) {
                self.DataMember = r;
            })
        }

        getDataMember();

        BoardDataFactory.getKanban().success(function (r) {  //------
            // console.log(r);
            self.kanbanBoard = BoardService.kanbanBoard(r);
            if ((self.kanbanBoard.columns[0].cards.length == 0) && (self.kanbanBoard.columns[1].cards.length == 0)
                && (self.kanbanBoard.columns[2].cards.length == 0) && (self.kanbanBoard.columns[3].cards.length != 0)) {
                self.checkComplete = 1;
            } else {
                self.checkComplete = 0;
            }

        });


        self.kanbanSortOptions = {

            //restrict move across columns. move only within column.
            /*accept: function (sourceItemHandleScope, destSortableScope) {
             return sourceItemHandleScope.itemScope.sortableScope.$id !== destSortableScope.$id;
             },*/
            itemMoved: function (event) {

              if ((event.dest.sortableScope.$parent.column.name == "Doing"
                && event.dest.sortableScope.$parent.column.cards.length > self.DataMember.board.worklimit)
                && self.DataMember.board.worklimit != 0){

              event.dest.sortableScope.removeItem(event.dest.index);
              event.source.itemScope.sortableScope.insertItem(event.source.index, event.source.itemScope.modelValue);

          }else {

                    var AfterID;
                    var BeforeID = event.source.itemScope.modelValue.status_id;


                    if (event.dest.sortableScope.$parent.column.name == "Backlog") {
                        AfterID = 1;
                    } else if (event.dest.sortableScope.$parent.column.name == "Ready") {
                        AfterID = 2;
                    } else if (event.dest.sortableScope.$parent.column.name == "Doing") {
                        AfterID = 3;
                    } else if (event.dest.sortableScope.$parent.column.name == "Done") {
                        AfterID = 4;
                    }


                    var $MoveEvent = {
                        cardId: event.source.itemScope.modelValue.id,
                        columnName: event.dest.sortableScope.$parent.column.name
                    };

                    BoardService.cardMove($MoveEvent)
                        .success(function (r) {
                            var beforeStatus = event.source.itemScope.modelValue.status;
                            var afterStatus = event.dest.sortableScope.$parent.column.name;
                            BoardDataFactory.getKanban().success(function (r) {  //------
                                // console.log(r);
                                self.kanbanBoard = BoardService.kanbanBoard(r);
                                // console.log(self.kanbanBoard)

                                if (BeforeID - AfterID < 0) {           //----------------------- After Moved
                                    BoardService.afterMove(beforeStatus, afterStatus);
                                } else {
                                    BoardService.afterMoveBack(event.source.itemScope.modelValue.id, beforeStatus, afterStatus)
                                }


                            });

                            if ((self.kanbanBoard.columns[0].cards.length == 0) && (self.kanbanBoard.columns[1].cards.length == 0)
                                && (self.kanbanBoard.columns[2].cards.length == 0) && (self.kanbanBoard.columns[3].cards.length != 0)) {
                                self.checkComplete = 1;
                            } else {
                                self.checkComplete = 0;
                            }
                        });
               }

            },
            accept: function (event) {
                //console.log(event.itemScope.$parent.card.pre_card);
                if (event.itemScope.$parent.card.pre_card != null) {
                    var check = (event.itemScope.$parent.card.pre_card.status_id == 4);
                } else var check = true;


                return check;

            },

            orderChanged: function (event) {
                console.log(event)
            },
            dragStart: function (event) {
                //console.log(event)

            },
            containment: '#board'
        };

        self.removeCard = function (column, card) {
            BoardService.removeCard(self.kanbanBoard, column, card);
        };

        self.addNewCard = function (column) {
            BoardService.addNewCard(self.kanbanBoard, column);
        };

        self.detailCard = function (card) {
            BoardService.detailCard(card);
        };

        self.boardComplete = function () {
            BoardService.boardComplete();
        };

        self.boardInComplete = function () {
            BoardService.boardInComplete();
        };

        self.isOvertime = function (estimate, now, end) {  //--- เช็ค Over time
            var estimateDate = new Date(estimate);
            if (end == null) {

                return estimateDate < now;


            } else {
                var endA = new Date(end);
                return endA > estimateDate;

            }


        };


    }]);

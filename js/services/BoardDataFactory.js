/*jshint undef: false, unused: false, indent: 2*/
/*global angular: false */

'use strict';

angular.module('kanban').service('BoardDataFactory', function ($http) {


    return {

        getKanban : function(){
            return $http({
                method: 'GET',
                url : "/kanban/cards"
            })
        },


    };
});



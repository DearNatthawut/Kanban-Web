'use strict';

angular.module('kanban', [
        'ngRoute',
        'ui.sortable',
        'ui.bootstrap',
        'gantt', 'gantt.table',
        'gantt.tooltips',
        'xeditable'
    ])

    .config(['$compileProvider', function ($compileProvider) {
        $compileProvider.debugInfoEnabled(false); // testing issue #144
    }])
    .config(['$routeProvider', function ($routeProvider) {

        $routeProvider.when('/', {templateUrl: '/kanban/views/kanban.html'});

        $routeProvider.when('/kanban', {templateUrl: '/kanban/views/kanban.html', controller: 'KanbanController'});

        $routeProvider.otherwise({redirectTo: '/'});
    }])

    .run(function (editableOptions) {
        editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    });
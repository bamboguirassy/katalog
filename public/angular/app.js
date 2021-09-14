var app = angular.module('Katalog', ['angular.filter'],
    ($interpolateProvider) => {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });
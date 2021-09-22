var app = angular.module('Katalog', ['angular.filter','autoCompleteModule'],
    ($interpolateProvider) => {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });
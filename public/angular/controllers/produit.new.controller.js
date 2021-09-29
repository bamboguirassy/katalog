app.controller('ProduitNewController', ($scope) => {
    $scope.attributs = [];
    $scope.hasMoreAttr = 0;
    $scope.selectedAttrs = [];
    $scope.isMulticolor = 0;
    $scope.prixSurDemande = 0;

    $scope.toggleAttrSelection = (selected) => {
        if (!$scope.selectedAttrs.includes(selected)) {
            $scope.selectedAttrs.push(selected);
        } else {
            $scope.selectedAttrs = $scope.selectedAttrs.filter((s) => { return s.id != selected.id });
        }
    };

    $scope.toggleIsMulticolor = (val) => {
        $scope.isMulticolor = val;
    };

    $scope.toggleHasMoreAttr = (val) => {
        $scope.hasMoreAttr = val;
    };

});
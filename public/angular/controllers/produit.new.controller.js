app.controller('ProduitNewController', ($scope) => {
    $scope.attributs = [];
    $scope.hasMoreAttr = 0;
    $scope.selectedAttrs = [];

    $scope.toggleAttrSelection = (selected) => {
        if (!$scope.selectedAttrs.includes(selected)) {
            $scope.selectedAttrs.push(selected);
        } else {
            $scope.selectedAttrs = $scope.selectedAttrs.filter((s) => { return s.id != selected.id });
        }
    }

});
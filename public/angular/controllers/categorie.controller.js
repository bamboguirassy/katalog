app.controller('CategorieController', ($scope, $rootScope) => {
    $scope.selected = null;

    $scope.setSelected = (categorie) => {
        $scope.selected = categorie;
    }

    $scope.init = (categories) => {
        $scope.categories = categories;
    }

    $scope.cancelEdit = () => {
        $scope.selected = null;
    }
    
    $scope.submitEditForm = ()=>{
        $('#catEditForm').attr('action',`/${$rootScope.shop.pseudonyme}/categorie/${$scope.selected.id}`);
        $('#catEditForm').submit();
    }
})
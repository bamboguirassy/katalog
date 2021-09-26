app.controller('ShopNewController', ($scope) => {
    $scope.pseudonyme = '';
    $scope.handleShopNameChange = (nom) => {
        $scope.pseudonyme = nom.replace(/[&\/\\#,+()$~%.'":*?<>{}/ ]/g, ''),
            $scope.pseudonyme = $scope.pseudonyme.toLowerCase();
    }

    $scope.init = (shop) => {
        $scope.shop = shop;
    }

    $scope.handleShopNameChangeUpdate = () => {
        $scope.shop.pseudonyme = $scope.shop.nom.replace(/[&\/\\#,+()$~%.'":*?<>{}/ ]/g, ''),
            $scope.shop.pseudonyme = $scope.shop.pseudonyme.toLowerCase();
    }
})
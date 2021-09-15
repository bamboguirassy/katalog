app.controller('ShopNewController',($scope)=>{
    $scope.pseudonyme = '';
    $scope.handleShopNameChange = (nom) => {
        $scope.pseudonyme = nom.replace(/[&\/\\#,+()$~%.'":*?<>{}/ ]/g, ''),
        $scope.pseudonyme = $scope.pseudonyme.toLowerCase();
    }
})
app.controller('PanierController', ($scope, PanierService) => {
    $scope.panier = {};
    $scope.initPanier = (panier, montant) => {
        $scope.panier = panier;
        $scope.montant = montant;
    }

    refreshPanier = () => {
        PanierService.getMyPanierContents()
            .success((response) => {
                $scope.panier = response.panier;
                $scope.montant = response.montant;
            }).error(err => alert(err.message));
    }

    $scope.reduceProduct = (produit) => {
        produit.quantite--;
        if (produit.quantite == 0) {
            if (confirm("Souhaitez-vous supprimer ce produit ?")) {
                removeProduit();
            } else {
                produit.quantite++;
            }
        } else {
            updateProduct(produit);
        }
    }

    $scope.addMore = (produit) => {
        produit.quantite++;
        updateProduct(produit);
    }

    updateProduct = (produit) => {
        PanierService.updatePaproductQuantite(produit)
            .success((response) => {
                if (response.error) {
                    alert(response.message)
                } else {
                    refreshPanier();
                }
            }).error(err => alert(err.message));
    }

    $scope.removeProduit = (produit) => {
        PanierService.removePaproductFromPanier(produit)
        .success((response) => {
            if (response.error) {
                alert(response.message)
            } else {
                refreshPanier();
            }
        }).error(err => alert(err.message));
    }
});
app.controller('PanierController', ($scope, PanierService) => {
    $scope.panier = {};
    $scope.initPanier = (panier, montant) => {
        $scope.panier = panier;
        $scope.montant = montant;
    }

    refreshPanier = () => {
        PanierService.getMyPanierContents()
            .then((response) => {
                response = response.data;
                $scope.panier = response.panier;
                $scope.montant = response.montant;
            },err => alert(err.data.message));
    }

    $scope.reduceProduct = (produit) => {
        produit.quantite--;
        if (produit.quantite == 0) {
            if (confirm("Souhaitez-vous supprimer ce produit ?")) {
                $scope.removeProduit(produit);
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
            .then((response) => {
                response = response.data;
                if (response.error) {
                    alert(response.message)
                } else {
                    refreshPanier();
                }
            },err => alert(err.data.message));
    }

    $scope.removeProduit = (produit) => {
        PanierService.removePaproductFromPanier(produit)
        .then((response) => {
            response = response.data;
            if (response.error) {
                alert(response.message)
            } else {
                refreshPanier();
            }
        },err => alert(err.data.message));
    }
});
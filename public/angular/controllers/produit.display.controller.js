app.controller('ProduitDisplayController', ($scope) => {
    $scope.produit = {};
    $scope.sProduit = {};
    $scope.filteredVariants = [];
    $scope.selectedFilters = [];
    $scope.variantSelected =false;
    $scope.init = (produit) => {
        $scope.produit = produit;
        $scope.sProduit = produit;
    };

    $scope.select = (variant) => {
        $scope.sProduit = variant;
        $scope.variantSelected = true;
    }

   /* $scope.filter = (valeurAttribut, key) => {
        $scope.selectedFilters[key] = valeurAttribut;
        $scope.selectedFilters.forEach(selectedFilter => {
            if ($scope.filteredVariants.length < 1) {
                $scope.filteredVariants = $scope.produit.variants.filter(variant => {
                    return variant.attribut_values.map(val => val.valeur_attribut_produit_id).includes(selectedFilter.id);
                });
            } else {
                $scope.filteredVariants = $scope.filteredVariants.filter(variant => {
                    return variant.attribut_values.map(val => val.valeur_attribut_produit_id).includes(selectedFilter.id);
                });
                if ($scope.filteredVariants.length < 1) {
                    $scope.filteredVariants = $scope.produit.variants.filter(variant => {
                        return variant.attribut_values.map(val => val.valeur_attribut_produit_id).includes(selectedFilter.id);
                    });
                }
            }
        })
        if ($scope.filteredVariants.length > 0) {
            $scope.sProduit = $scope.filteredVariants[0];
        }
    };*/
});
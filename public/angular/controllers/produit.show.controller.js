app.controller('ProduitShowController', ($scope, ProduitService) => {

    $scope.produit = {};
    $scope.attributs = [];
    $scope.selectedAttrs = [];

    $scope.toggleAttrSelection = (selected) => {
        if (!$scope.selectedAttrs.includes(selected)) {
            $scope.selectedAttrs.push(selected);
        } else {
            $scope.selectedAttrs = $scope.selectedAttrs.filter((s) => { return s.id != selected.id });
        }
    }

    $scope.init = (produit, attributs) => {
        $scope.produit = produit;
        $scope.attributs = attributs;
    }

    $scope.addNewValuesToAttribute = (attributProduit) => {
        ProduitService.addValeursToAttribut(attributProduit.id, attributProduit.newValues)
            .success(() => {
                $scope.refresh();
            }).error(err => console.log(err));
    }

    $scope.removeAttribute = (attribut) => {
        if (confirm("Êtes-vous sûrs de vouloir supprimer cet attributs et toutes ses valeurs")) {
            ProduitService.removeAttribut(attribut.id)
                .success(data => {
                    if (data.error) {
                        alert(data.message);
                    } else {
                        $scope.refresh();
                    }
                }).error(err => console.log(err));
        }
    }

    $scope.removeValue = (valeur) => {
        console.log(valeur);
        if (confirm("Êtes-vous sûrs de vouloir supprimer cette valeur")) {
            ProduitService.removeValeurAttribut(valeur.id)
                .success(data => {
                    if (data.error) {
                        alert(data.message);
                    } else {
                        $scope.refresh();
                    }
                }).error(err => console.log(err));
        }

    };

    $scope.refresh = () => {
        ProduitService.find($scope.produit.id)
            .success(data => {
                $scope.produit = data.produit;
                $scope.attributs = data.attributs;
            }).error(err => console.log(err));
    };

    $scope.generateCombination = () => {
        ProduitService.generateCombination($scope.produit.id)
            .success(() => {
                $scope.refresh();
            }).error(err => console.log(err))
    }

    $scope.removeVariant = (variant) => {
        if (confirm("Êtes-vous sûrs de vouloir supprimer cette variante ? L'opération est irréversible...")) {
        ProduitService.removeVariant(variant.id)
            .success(data => {
                if (data.error) {
                    alert(data.message);
                } else {
                    $scope.refresh();
                }
            }).error(err => console.log(err));
        }
    }

    $scope.updateVariant = (variant) => {
        ProduitService.updateVariant(variant)
            .success(data => {
                if (data.error) {
                    alert(data.message);
                } else {
                    variant.configured=true;
                }
            }).error(err => console.log(err));
    }
});
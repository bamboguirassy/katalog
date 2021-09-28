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
            .then(() => {
                $scope.refresh();
            },err => alert(err.data.message));
    }

    $scope.removeAttribute = (attribut) => {
        if (confirm("Êtes-vous sûrs de vouloir supprimer cet attributs et toutes ses valeurs")) {
            ProduitService.removeAttribut(attribut.id)
                .then(response => {
                    let data = response.data;
                    if (data.error) {
                        alert(data.message);
                    } else {
                        $scope.refresh();
                    }
                },err => alert(err.data.message));
        }
    }

    $scope.removeValue = (valeur) => {
        console.log(valeur);
        if (confirm("Êtes-vous sûrs de vouloir supprimer cette valeur")) {
            ProduitService.removeValeurAttribut(valeur.id)
                .then(response => {
                    let data = response.data;
                    if (data.error) {
                        alert(data.message);
                    } else {
                        $scope.refresh();
                    }
                },err => alert(err.data.message));
        }

    };

    $scope.refresh = () => {
        ProduitService.find($scope.produit.id)
            .then(response => {
                let data = response.data;
                $scope.produit = data.produit;
                $scope.attributs = data.attributs;
            },err => alert(err.data.message));
    };

    $scope.generateCombination = () => {
        ProduitService.generateCombination($scope.produit.id)
            .then(() => {
                $scope.refresh();
            },err => alert(err.data.message))
    }

    $scope.removeVariant = (variant) => {
        if (confirm("Êtes-vous sûrs de vouloir supprimer cette variante ? L'opération est irréversible...")) {
        ProduitService.remove(variant.id)
            .then(response => {
                let data = response.data;
                if (data.error) {
                    alert(data.message);
                } else {
                    $scope.refresh();
                }
            },err => alert(err.data.message));
        }
    }

    $scope.updateVariant = (variant) => {
        ProduitService.update(variant)
            .then(response => {
                let data = response.data;
                if (data.error) {
                    alert(data.message);
                } else {
                    variant.configured=true;
                }
            },err => alert(err.data.message));
    }
});
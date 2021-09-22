app.factory('ProduitService',($rootScope, $http) => {
    return {
        find: (produitId) => {
            return $http.get(`/${$rootScope.shop.pseudonyme}/produit/${produitId}/refresh`);
        },
        removeValeurAttribut: (valeurAttributProduitId) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/attributproduit/${valeurAttributProduitId}/remove-valeur`);
        },
        removeAttribut: (attributProduitId) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/attributproduit/${attributProduitId}/remove`);
        },
        addValeursToAttribut: (attributProduitId, valeurs) => {
            return $http.post(`/${$rootScope.shop.pseudonyme}/attributproduit/${attributProduitId}/add-valeurs`,{valeurs});
        },
        generateCombination: (produitId) => {
            return $http.post(`/${$rootScope.shop.pseudonyme}/produit/${produitId}/create-combination`);
        },
        remove: (variantId) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/produit/${variantId}/remove-variant`);
        },
        update: (variant) => {
            return $http.put(`/${$rootScope.shop.pseudonyme}/produit/${variant.id}/update-variant`,variant);
        }
    }
})
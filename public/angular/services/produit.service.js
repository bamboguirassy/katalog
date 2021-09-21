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
        removeVariant: (variantId) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/produitvariant/${variantId}`);
        },
        updateVariant: (variant) => {
            return $http.put(`/${$rootScope.shop.pseudonyme}/produitvariant/${variant.id}`,variant);
        }
    }
})
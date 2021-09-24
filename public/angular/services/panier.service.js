app.factory('PanierService', ($http, $rootScope) => {
    return {
        getMyPanierContents: () => {
            return $http.get(`/${$rootScope.shop.pseudonyme}/panier/content`);
        },
        updatePaproductQuantite: (produit) => {
            return $http.put(`/${$rootScope.shop.pseudonyme}/panier/update-product-quantite/${produit.id}`,produit);
        },
        removePaproductFromPanier: (produit) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/panier/remove-product/${produit.id}`);
        }
    }
})
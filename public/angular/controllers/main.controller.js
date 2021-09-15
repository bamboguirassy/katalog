app.controller('MainController', ($rootScope) => {
    $rootScope.user = null;
    $rootScope.shop = null;
    $rootScope.selectedProduct = null;

    $rootScope.setCurrentUser = (user) => {
        $rootScope.user = user;
    }

    $rootScope.setCurrentShop = (shop) => {
        $rootScope.shop = shop;
    }

    $rootScope.initProductToPanier = (produit) => {
        $rootScope.selectedProduct = produit;
        if ($rootScope.user == null) {
            displayLoginModal();
        } else {
            if($rootScope.user.type=='client') {
                $rootScope.selectedProduct = produit;
                $('#mbr-popup-34').modal('toggle');
            } else {
                alert('Seuls les clients sont sensés ajouter des produits au panier');
            }
        }
    }

    displayLoginModal = () => {
        $('#mbr-popup-1f').modal('toggle');
    }

    $rootScope.displayRegisterModal = () => {
        displayLoginModal();
        $('#mbr-popup-3a').modal('toggle');
    }

    $rootScope.addProductToPanier = (produit, quantite) => {

    }

    $rootScope.removeProductFromPanier = (item) => {

    }

    $rootScope.changeCommandeStatus = (commande, status) => {

    }

});
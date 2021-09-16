app.controller('MainController', ($rootScope, $http) => {
    $rootScope.user = null;
    $rootScope.shop = null;
    $rootScope.selectedProduct = null;
    $rootScope.panier = null;

    $rootScope.setCurrentUser = (user) => {
        $rootScope.user = user;
    }
    
    $rootScope.setCurrentShop = (shop) => {
        $rootScope.shop = shop;
        setTimeout(()=>{
            if($rootScope.user && $rootScope.user.type=='client') {
                $rootScope.getPanier();
            }
        },1000);
    }

    $rootScope.initProductToPanier = (produit) => {
        $rootScope.selectedProduct = produit;
        if ($rootScope.user == null) {
            displayLoginModal();
        } else {
            if ($rootScope.user.type == 'client') {
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

    $rootScope.getPanier = () => {
        $http.get(`/${$rootScope.shop.pseudonyme}/user/panier`)
        .success((data)=>{
            if(data) {
                $rootScope.panier = data[0];
            }
        }).error(err=>console.log(err));
    }

    $('#logo-formbuilder-q').change(()=>{
        $('#shopLogoUpdate').submit();
    });

});
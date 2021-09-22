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
        setTimeout(() => {
            if ($rootScope.user && $rootScope.user.type == 'client') {
                $rootScope.getPanier();
            }
        }, 1000);
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
            .success((data) => {
                if (data) {
                    $rootScope.panier = data[0];
                }
            }).error(err => console.log(err));
    }

    $('#logo-formbuilder-q').change(() => {
        $('#shopLogoUpdate').submit();
    });

    $rootScope.shopName = null;
    $rootScope.produitName = null;

    $rootScope.shopAutoCompleteOptions = {
        minimumChars: 3,
        dropdownWidth: '500px',
        dropdownHeight: '200px',
        noMatchTemplate: `<span>Aucun résultat pour '[[entry.searchText]]'</span>`,
        data: function (searchText) {
            return $http.get('/shop-autocomplete')
                .then(function (response) {
                    // ideally filtering should be done on server
                    searchText = searchText.toUpperCase();

                    return _.filter(response.data, function (shop) {
                        return shop.nom.toUpperCase() == searchText
                            || shop.nom.toUpperCase().startsWith(searchText)
                            || shop.pseudonyme.toUpperCase() == searchText
                            || shop.pseudonyme.toUpperCase().startsWith(searchText)
                            || shop.nom.toUpperCase().includes(searchText) 
                            || shop.pseudonyme.toUpperCase().includes(searchText);
                    });
                });
        },
        renderItem: function (item) {
            return {
                value: item.nom,
                label: `
                <div style="width: 100%; text-align: left;">
                    <div style="width: 30%; display: inline;">
                        <img style="width: 80px; display:inline;" src="/storage/shops/[[item.logo]]">
                    </div>
                    <div  style="width: 70%; display: inline;">
                        <span style="font-size: 25px; font-weight: bold;">[[entry.item.nom]]</span>
                    </div>    
                </div>
                `
            };
        },
        itemSelected: function (e) {
            window.location.href = `/${e.item.pseudonyme}`;
        }
    };

    $rootScope.produitAutoCompleteOptions = {
        minimumChars: 2,
        dropdownWidth: '350px',
        dropdownHeight: '200px',
        noMatchTemplate: `<span>Aucun résultat pour '[[entry.searchText]]'</span>`,
        data: function (searchText) {
            return $http.get(`/${$rootScope.shop.pseudonyme}/produit-autocomplete`)
                .then(function (response) {
                    // ideally filtering should be done on server
                    searchText = searchText.toUpperCase();

                    return _.filter(response.data, function (produit) {
                        return produit.nom.toUpperCase() == searchText
                            || produit.nom.toUpperCase().startsWith(searchText) 
                            || produit.nom.toUpperCase().includes(searchText);
                    });
                });
        },
        renderItem: function (item) {
            return {
                value: item.nom,
                label: `
                <div style="width: 100%; text-align: left;">
                    <div style="width: 30%; display: inline;">
                        <img style="width: 80px; display: inline;" src="/storage/produits/images/[[entry.item.image_couverture.nom]]">
                    </div>
                    <div  style="width: 70%; display: inline;">
                        <span style="font-size: 20px; font-weight: bold;">[[entry.item.nom]]</span>
                    </div>    
                </div>
                `
            };
        },
        itemSelected: function (e) {
            if($rootScope.user.id==$rootScope.shop.user_id) {
                window.location.href = `/${$rootScope.shop.pseudonyme}/produit/${e.item.id}`;
            } else {
                window.location.href = `/${$rootScope.shop.pseudonyme}/produit/${e.item.id}/display`;
            }
        }
    };

});
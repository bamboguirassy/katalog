app.factory('AttributService',($http, $rootScope)=>{
    return {
        findAll: () => {
            return $http.get(`/${$rootScope.shop.pseudonyme}/attribut/find_all`)
        },
        store: (attribut) => {
            return $http.post(`/${$rootScope.shop.pseudonyme}/attribut`,attribut)
        },
        update: (attribut) => {
            return $http.put(`/${$rootScope.shop.pseudonyme}/attribut/${attribut.id}`);
        },
        destroy: (attribut) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/attribut/${attribut.id}`)
        },
        addValeur: (valeurAttribut) => {
            return $http.post(`/${$rootScope.shop.pseudonyme}/valeurattribut`,valeurAttribut);
        },
        updateValeur: (valeurAttribut) => {
            return $http.put(`/${$rootScope.shop.pseudonyme}/valeurattribut/${valeurAttribut.id}`);
        },
        removeValeur: (valeurAttribut) => {
            return $http.delete(`/${$rootScope.shop.pseudonyme}/valeurattribut/${valeurAttribut.id}`)
        }
    }
})
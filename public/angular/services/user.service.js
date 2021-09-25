app.factory('UserService',($rootScope, $http) => {
    return {
        login: (userData) => {
            return $http.post(`/login`,userData);
        },
        register: (userData) => {
            return $http.post(`/user`,userData);
        }
    }
})
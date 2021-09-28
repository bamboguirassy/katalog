app.controller('UserController', ($scope, UserService) => {
    $scope.userData = {};

    $scope.login = () => {
        UserService.login($scope.userData)
            .then((response) => {
                response = response.data;
                if (response.error) {
                    alert(response.message);
                } else {
                    let user = response.data;
                    if (user.type == 'owner') {
                        window.location.href = `/${user.shop.pseudonyme}`;
                    } else {
                        window.location.href = window.location.href;
                    }
                }
            }, err => log(err.data.message));
    };

    $scope.register = () => {
        UserService.register($scope.userData)
            .then((response) => {
                response = response.data;
                if (response.error) {
                    alert(response.message);
                } else {
                    let user = response.data;
                    if (user.type == 'owner') {
                        window.location.href = `/${user.shop.pseudonyme}`;
                    } else {
                        window.location.reload();
                    }
                }
            }, err => alert(err.data.message));
    }
})
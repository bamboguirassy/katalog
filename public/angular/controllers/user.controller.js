app.controller('UserController',($scope, UserService) => {
    $scope.userData = {};

    $scope.login = () => {
        UserService.login($scope.userData)
        .success((response)=>{
            if(response.error) {
                alert(response.message);
            } else {
                let user = response.data;
                if(user.type=='owner') {
                    window.location.href=`/${user.shop.pseudonyme}`;
                } else {
                    window.location.href=window.location.href;
                }
            }
        }).error(err=>alert(err.message));
    };

    $scope.register = () => {
        UserService.register($scope.userData)
        .success((response)=>{
            if(response.error) {
                alert(response.message);
            } else {
                let user = response.data;
                if(user.type=='owner') {
                    window.location.href=`/${user.shop.pseudonyme}`;
                } else {
                    window.location.reload();
                }
            }
        }).error(err=>alert(err.message));
    }
})
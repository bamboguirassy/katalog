app.controller('AttributListController',($scope, AttributService)=> {
    $scope.attributs = [];
    $scope.newAttribut = {type:'texte'};
    $scope.currentAttribut = null;
    $scope.newValue = {};
    

    $scope.findAll = () => {
        AttributService.findAll()
        .success((data)=>{
            $scope.attributs = data;
        }).error(err=>console.log(err));
    }

    $scope.findAll();

    $scope.setCurrent = (attribut) => {
        $scope.currentAttribut = attribut;
    }

    $scope.openAttributValueModal = (attribut) => {
        $scope.setCurrent(attribut);
        $('#mbr-popup-44').modal('toggle');
    }

    $scope.addAttribut = () => {
        AttributService.store($scope.newAttribut)
        .success((response)=>{
            if(response.error) {
                alert(response.mmessage);
            } else {
                $scope.attributs = response.data;
                $scope.newAttribut = {type:'texte'};
                $scope.findAll();
            }
        }).error(err=>console.log(err));
    }
    
    $scope.updateAttribut = () => {
        AttributService.update($scope.newAttribut)
        .success((response)=>{
            if(response.error) {
                alert(response.mmessage);
            } else {
                $scope.findAll();
            }
        }).error(err=>console.log(err));
    }
    
    $scope.removeAttribut = (attribut) => {
        if(confirm("Etes-vous sûr de vouloir supprimer cet attribut et toutes ses valeurs ?")) {
            AttributService.destroy(attribut)
            .success((response)=>{
                if(response.error) {
                    alert(response.mmessage);
                } else {
                    $scope.findAll();
                }
            }).error(err=>alert(err.message));
        }
    }
    
    $scope.addNewValue = () => {
        $scope.newValue.attribut_id = $scope.currentAttribut.id;
        AttributService.addValeur($scope.newValue)
        .success((response)=>{
            if(response.error) {
                alert(response.mmessage);
            } else {
                $('#mbr-popup-44').modal('toggle');
                $scope.newValue = {};
                $scope.currentAttribut.valeurs.push(response.data);
            }
        }).error(err=>console.log(err));
    }
    
});
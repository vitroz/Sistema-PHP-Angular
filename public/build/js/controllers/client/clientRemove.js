angular.module('app.controllers')

.controller('ClientRemoveController',
	['$scope','$location','$routeParams' ,'Client',
	 function($scope,$location,$routeParams,Client){
		$scope.client = Client.get({id: $routeParams.id});
		//Preenche os campos do formulario com os dados presentes no BD

	$scope.remove = function(){
		$scope.client.$delete().then(function(){
			$location.path('/clients');
		})
	}

}]);
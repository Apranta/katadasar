var app = angular.module("KataDasar", []);

app.controller('InputCtrl', function($scope, $http) {
	$scope.data = {};
	$scope.submit =function(){
		var link = 'http://katadasar.azurewebsites.net/api.php?action=kirim';
		if ($scope.data.kata_dasar!='') {
			$http.post(link,{
				kata_dasar:$scope.data.kata_dasar,
				suku_kata:$scope.data.suku_kata
			}).then(function(res){
				alert('Terimakasih :)');
				$scope.data ={};
			})
		}
	}
});

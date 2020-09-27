var app = angular.module('country', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[country=csrf-token]').attr('content');
    }]);

//Ország Controller
app.controller('CountryController', ['$scope', '$http', function ($scope, $http) {

    $scope.Country = [];

    //Ország listázása
    $scope.loadCountry = function () {
        $http.get('/api/countries')
            .then(function success(e) {
                $scope.country = e.data.country;
            });
    };
    $scope.loadCountry();



    $scope.errors = [];

    $scope.Country = {
        Country: '',
    };
    $scope.initCountry = function () {
        $scope.resetForm();
        $("#add_new_Country").modal('show');
    };

// Új ország hozzáadása
    $scope.addCountry = function () {
        $http.post('api/countries', {
            country: $scope.Country.country
        }).then(function success(e) {
            $scope.resetForm();
            $scope.country.push(e.data.country);
            $("#add_new_Country").modal('hide');

        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.country) {
            $scope.errors.push(error.data.errors.country[0]);
        }
    };

    $scope.resetForm = function () {
        $scope.Country.Country = '';
        $scope.errors = [];
    };


    //Ország szerkesztése
    $scope.edit_country = {};
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_country = $scope.country[index];
        $("#edit_country").modal('show');
    };


    $scope.updatecountry = function () {
        $http.patch('api/countries/' + $scope.edit_country.id, {
            country: $scope.edit_country.country
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_country").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };


// Ország törlése
    $scope.deletecountry = function (index) {
        var conf = confirm("Biztosan törölni akarod az Országot?");

        if (conf === true) {
            $http.delete('api/countries/' + $scope.country[index].id)
                .then(function success(e) {
                    $scope.country.splice(index, 1);
                });
        }
    };

    $scope.openCountry = function (index) {
        window.open('/country/'+index, "_self");
    };


}]);


//Város Controller
app.controller('CityController', ['$scope', '$http', function ($scope, $http) {

    $scope.city = [];

    //Városok listázása
    $scope.loadcity = function () {
        $http.get('/api/cities/' + document.getElementById('country_id').value)
            .then(function success(e) {
                $scope.city = e.data.City;
            });
    };
    $scope.loadcity();



    $scope.errors = [];

    $scope.city = {
        city: '',
    };
    $scope.initcity = function () {
        $scope.resetForm();
        $("#add_new_city").modal('show');
    };

    // Új város hozzáadása
    $scope.addcity = function () {
        $http.post('/api/cities', {
            City: $scope.city.city,
            country_id: document.getElementById('country_id').value
        }).then(function success(e) {
            $scope.loadcity();
            $("#add_new_city").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.city) {
            $scope.errors.push(error.data.errors.city[0]);
        }
    };

    $scope.resetForm = function () {
        $scope.city.city = '';
        $scope.errors = [];
    };


    //Város szerkesztése
    $scope.edit_city = {};
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_city = $scope.city[index];
        $("#edit_city").modal('show');
    };


    $scope.updatecity = function () {
        $http.patch('/api/cities/' + $scope.edit_city.id, {
            City: $scope.edit_city.city,
            country_id: document.getElementById('country_id').value
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_city").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    // Város törlése
    $scope.deletecity = function (index) {
        var conf = confirm("Biztosan törölni akarod a várost?");

        if (conf === true) {
            $http.delete('/api/cities/' + $scope.city[index].id)
                .then(function success(e) {
                    $scope.city.splice(index, 1);
                });
        }
    };
}]);
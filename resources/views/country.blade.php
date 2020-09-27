<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="country">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cloudent-Test</title>

    <!--Angular -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="{{ asset('js/angular1.6.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="container" ng-controller="CityController">
    <h3>{{ $country -> country }} városai</h3>  <br>
    <input type="hidden" id="country_id" name="{{ $country -> id }}" value="{{ $country -> id }}" ng-model="city.city">
    <div class="modal fade" tabindex="-1" role="dialog" id="add_new_city">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Város hozzáadása</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger" ng-if="errors.length > 0">
                        <ul>
                            <li ng-repeat="error in errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Város neve</label>
                        <input type="text" name="city" class="form-control" ng-model="city.city">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
                    <button type="button" class="btn btn-primary" ng-click="addcity()">Felvitel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="edit_city">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Város szerkesztése</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger" ng-if="errors.length > 0">
                        <ul>
                            <li ng-repeat="error in errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Város neve</label>
                        <input type="text" name="city" class="form-control" ng-model="edit_city.city">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
                    <button type="button" class="btn btn-primary" ng-click="updatecity()">Szerkesztés</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary btn-xs pull-right" ng-click="initcity()">Város hozzáadása</button>
                    <button class="btn btn-primary btn-xs pull-right" onclick="javascript:history.back();">Vissza</button>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-bordered table-striped" ng-if="city.length > 0">
                        <tr>
                            <th>id</th>
                            <th>Város</th>
                            <th>Funkciók</th>
                        </tr>
                        <tr ng-repeat="(index, city) in city">
                            <td>
                                @{{ index + 1 }}
                            </td>
                            <td>@{{ city.city }}</td>
                            <td>
                                <button class="btn btn-warning btn-xs" ng-click="initEdit(index)">Szerkesztés</button>
                                <button class="btn btn-danger btn-xs" ng-click="deletecity(index)" >Törlés</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


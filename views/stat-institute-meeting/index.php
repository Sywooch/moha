<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatInstituteMeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stat Institute Meetings');
$this->params['breadcrumbs'][] = $this->title;
?>
<style rel="stylesheet" href="css/angular-datepicker.css"></style>

<div class="row" ng-app="mohaApp" ng-controller="statInstituteMeetingController">
    <div class="col-sm-12">
        <label class="col-sm-12"><?= Yii::t('app', 'Phiscal Year') ?></label>
        <div class="col-sm-4">
            <select class="form-control" ng-model="year" ng-change="enquiry()" ng-options="y.year for y in years"></select>
        </div>
        <div class="col-sm-8">
            <div ng-show="response" class="alert alert-{{response.status == 200? 'success':'danger'}}">
                {{response.statusText}}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="panel panel-primary" style="margin-top: 2em" ng-show="year">
            <div class="panel-heading"><i class="fa fa-pencil"></i> </div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <label for=""><?= Yii::t('app', 'Title') ?></label>
                    <input type="text" class="form-control" ng-model="model.title" >
                </div>
                <div class="col-sm-2">
                    <label for=""><?= Yii::t('app', 'Total') ?></label>
                    <input type="number" min="0" class="form-control" ng-model="model.total">
                </div>
                <div class="col-sm-2">
                    <label for=""><?= Yii::t('app', 'Women') ?></label>
                    <input type="number" min="0" max="{{model.total}}" class="form-control" ng-model="model.women">
                </div>
                <div class="col-sm-3">
                    <label for=""><?= Yii::t('app', 'Start Date') ?></label>
                    <input id="start_date" class="form-control datepicker" data-ng-model="$parent.model.start_date" type="text" >
                </div>
                <div class="col-sm-3">
                    <label for=""><?= Yii::t('app', 'End Date') ?></label>
                    <input id="end_date" class="form-control datepicker" data-ng-model="$parent.model.end_date" type="text">
                </div>
                <div class="col-sm-2">
                    <label for=""><?= Yii::t('app', 'Times') ?></label>
                    <input type="number" min="0" class="form-control" ng-model="model.times">
                </div>
                <div class="col-sm-12">
                    <label for=""><?= Yii::t('app', 'Place') ?></label>
                    <input type="text" class="form-control" ng-model="model.place">
                </div>
                <div class="col-sm-2" style="margin-top: 1em">
                    <button type="button" class="btn btn-info col-sm-12" ng-click="create()">
                        <i class="fa fa-plus"></i> <?= Yii::t('app', 'New') ?>
                    </button>
                </div>
                <div class="col-sm-2" style="margin-top: 1em">
                    <button type="button" class="btn btn-primary col-sm-12" ng-click="save()">
                        <i class="fa fa-save"></i> <?= Yii::t('app', 'Save') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div ng-show="models" class="col-sm-12 card" style="margin-top: 2em">
        <div class="card-title-w-btn ">
            <h3><?= Yii::t('app', 'Statistics of Institution Meeting') ?></h3>
            <p>
                <a class="btn btn-default" target="_blank" href="{{url}}print&year={{year.id}}"><i class="fa fa-print fa-2x"></i></a>
                <a class="btn btn-info" target="_blank" href="{{url}}download&year={{year.id}}"><i class="fa fa-download fa-2x"></i></a>
            </p>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th class="text-center" rowspan="2"><?= Yii::t('app', 'No.') ?></th>
                <th class="text-center" rowspan="2"><?= Yii::t('app', 'Title') ?></th>
                <th class="text-center" colspan="2"><?= Yii::t('app', 'Attendance') ?></th>
                <th class="text-center" rowspan="2"><?= Yii::t('app', 'Date') ?></th>
                <th class="text-center" rowspan="2"><?= Yii::t('app', 'Times') ?></th>
                <th class="text-center" rowspan="2"><?= Yii::t('app', 'Place') ?></th>
            </tr>
            <tr>
                <th class="text-center"><?= Yii::t('app', 'T') ?></th>
                <th class="text-center"><?= Yii::t('app', 'W') ?></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="m in models" ng-click="select(m)">
                <td class="text-center">{{$index + 1}}</td>
                <td>{{m.title}}</td>
                <td class="text-center">{{m.total | number}}</td>
                <td class="text-center">{{m.women | number}}</td>
                <td class="text-center">{{m.start_date}} - {{m.end_date}}</td>
                <td class="text-center">{{m.times | number}}</td>
                <td class="text-center">{{m.place}}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th class="text-center" colspan="2"><?= Yii::t('app', 'Total') ?></th>
                <th class="text-center">{{sum('total')}}</th>
                <th class="text-center">{{sum('women')}}</th>
                <td></td>
                <td class="text-center">{{sum('times')}}</td>
                <td></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript" src="js/angular.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/datetimepicker.js"></script>
<script type="text/javascript" src="js/datetimepicker.templates.js"></script>
<script type="text/javascript">
  var app = angular.module('mohaApp', ['ui.bootstrap.datetimepicker']);
  app.controller('statInstituteMeetingController', function($scope, $http, $sce, $timeout) {
    $scope.url = 'index.php?r=stat-institute-meeting/';
    $http.get($scope.url + 'get')
      .then(function(r) {
        $scope.years = r.data.years;
      }, function(r) {
        $scope.response = r;
        $timeout(function () {
          $scope.response = null;
        }, 15000);
      });

    $scope.enquiry = function() {
      if($scope.year)
        $http.get($scope.url + 'enquiry&year='+ $scope.year.id)
          .then(function(r) {
            $scope.models = r.data.models;
          }, function(r) {
            $scope.response = r;
            $timeout(function () {
              $scope.response = null;
            }, 15000);
          });
    };

    $scope.create = function() {
      if($scope.model)
        if($scope.model.id)
          $scope.model.id = null;

      $scope.save();
    };

    $scope.select = function(m) {
      $scope.model = m;
      if($scope.model.total)
        $scope.model.total = parseInt($scope.model.total);
      if($scope.model.women)
        $scope.model.women = parseInt($scope.model.women);
      if($scope.model.times)
        $scope.model.times = parseInt($scope.model.times);

      $('#start_date').val($scope.model.start_date);
      $('#end_date').val($scope.model.end_date);
    };

    $scope.save = function() {
      if($scope.model && $scope.year) {
        $scope.model.start_date = $('#start_date').val();
        $scope.model.end_date = $('#end_date').val();
        $http.post($scope.url+'save&year='+ $scope.year.id, {
          'Model': $scope.model,
          '_csrf': $('meta[name="csrf-token"]').attr("content")
        }).then(function(r) {
          $scope.model = null;
          $scope.response = r;
          $scope.enquiry();
          $timeout(function() {
            $scope.response = null;
          }, 15000);
        }, function(r) {
          $scope.model = null;
          $scope.response = r;
          $timeout(function () {
            $scope.response = null;
          }, 15000);
        });
      }
    };

    $scope.sum = function(key) {
      var s = 0;
      if($scope.models)
        for(var i = 0; i < $scope.models.length; i++)
          if($scope.models[i][key])
            s += parseInt($scope.models[i][key]);
      return $scope.formatNumber(s);
    };

    $scope.formatNumber = function(num, dec) {
      if (dec === undefined) dec = 2;
      var r = "" + Math.abs(parseFloat(num).toFixed(dec));
      var decimals = "";
      if (r.lastIndexOf(".") != -1) {
        decimals = "." + r.substring(r.lastIndexOf(".") + 1);
        decimals = decimals.substring(0, Math.min(dec + 1, decimals.length)); // Take only 2 digits after decimals
        r = r.substring(0, r.lastIndexOf("."));
      }
      for (var i = r.length - 3; i > 0; i -= 3)
        r = r.substr(0, i) + "," + r.substr(i);
      return (num < 0 ? "-" : "") + r + decimals;
    }
  });
</script>
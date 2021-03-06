<?php $_GET['menu']=1;?>
<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatOfficerEthnicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ກົມຈັດຕັ້ງ ແລະ ພະນັກງານ'), 'url' => ['index']];
$this->title = 'ຕາຕະລາງຈຳນວນລັດຖະກອນແຍກຕາມຊົນເຜົ່າ';
// $this->params['breadcrumbs'][] = $this->title;
?>
<style rel="stylesheet" href="css/angular-datepicker.css"></style>
<div ng-app="mohaApp" ng-controller="statOfficerEthnic">
    <div class="col-sm-12">
        <label class="col-sm-12"><?= Yii::t('app', 'Phiscal Year') ?></label>
        <div class="col-sm-4">
            <select class="form-control" ng-model="year" ng-change="enquiry()"
                    ng-options="y.year for y in years"></select>
        </div>
        <div class="col-sm-8">
            <div ng-show="response" class="alert alert-{{response.status == 200? 'success':'danger'}}">
                {{response.statusText}}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="panel panel-primary" style="margin-top: 2em" ng-show="year">
            <div class="panel-heading" ng-click="changemode()"><i class="fa fa-{{mode=='input'?'minus':'plus'}}"></i> ປ້ອນຂໍ້ມູນ
            </div>
            <div class="panel-body {{mode=='input'?'':'hidden'}}">
                <div class="col-sm-3">
                    <label>ກະຊວງພາຍໃນ</label>
                    <select class="form-control" ng-model="model.level" ng-change="inquiry()"
                            ng-options="l.name for l in levels"></select>
                </div>
                <div class="col-sm-3">
                    <label>ຊົນເຜົ່າ</label>
                    <select class="form-control" ng-model="model.ethnic" ng-change="inquiry()"
                            ng-options="e.name for e in ethnics"></select>
                </div>
                <div class="col-sm-3">
                    <label>ລວມ</label>
                    <input type="number" ng-model="model.total" class="form-control"/>
                </div>
                <div class="col-sm-3">
                    <label>ຍິງ</label>
                    <input type="number" ng-model="model.women" class="form-control"/>
                </div>
                <div class="col-sm-12" style="margin-top: 1em">
                    <button type="button" class="btn btn-primary col-sm-2" ng-click="save()">
                        <i class="fa fa-save"></i> <?= Yii::t('app', 'Save') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" ng-show="year">
        <div class="card">
            <div class="bs-component">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#table" data-toggle="tab">ຕາຕະລາງ</a></li>
                    <li><a href="#reference" data-toggle="tab">ເອກະສານອ້າງອີງ</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="table">
                        <div class="row">
                            <div class="col-sm-12" ng-bind-html="result"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reference">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>ເລກທີ</label>
                                <input type="text" ng-model="issued_no" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>ລົງວັນທີ</label>
                                <input id="issued_date" class="form-control datepicker"
                                       data-ng-model="$parent.issued_date"
                                       type="text">
                            </div>
                            <div class="col-sm-3">
                                <label>ອອກໂດຍ</label>
                                <input type="text" ng-model="issued_by" class="form-control">
                            </div>

                            <div class="col-sm-3">
                                <label>ເລືອກໄຟລ໌</label>
                                <input type="file" name="image"
                                       onchange="angular.element(this).scope().uploadedFile(this);"
                                       class="form-control" required>
                            </div>

                            <div class="col-sm-12" ng-if="references">
                                <div class="card">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">ວັນທີອັບໂຫຼດ</th>
                                            <th class="text-center">ຊື່</th>
                                            <th class="text-center">ເລກທີ</th>
                                            <th class="text-center">ລົງວັນທີ</th>
                                            <th class="text-center">ອອກໂດຍ</th>
                                            <th class="text-center">ລຶບ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="f in references">
                                            <td class="text-center">{{f.upload_date}}</td>
                                            <td class="text-center"><a href="upload/{{f.dir}}/{{f.name}}"
                                                                       target="_blank">{{f.original_name}}</a>
                                            </td>
                                            <td class="text-center">{{f.issued_no}}</td>
                                            <td class="text-center">{{f.issued_date | date}}</td>
                                            <td class="text-center">{{f.issued_by}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger" type="button" ng-click="deletefile(f)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/angular.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/datetimepicker.js"></script>
<script type="text/javascript" src="js/datetimepicker.templates.js"></script>
<script type="text/javascript">
  var app = angular.module('mohaApp', ['ui.bootstrap.datetimepicker']);
  app.filter('dash', function() {
    return function(input) {
      return input ? input : '-';
    };
  });
  app.controller('statOfficerEthnic', function ($scope, $http, $sce, $timeout) {
    $scope.url = 'index.php?r=stat-officer-ethnic/';
    $scope.mode = 'read';
    $scope.changemode = function () {
      $scope.mode = $scope.mode == 'read' ? 'input' : 'read';
    };
    $http.get($scope.url + 'get')
      .then(function (r) {
        $scope.years = r.data.years;
        $scope.levels = r.data.levels;
        $scope.ethnics = r.data.ethnics;
      }, function (r) {
        $scope.response = r;
        $timeout(function () {
          $scope.response = null;
        }, 15000);
      });

    $scope.enquiry = function () {
      if ($scope.year) {
        $http.get($scope.url + 'enquiry&year=' + $scope.year.id)
          .then(function (r) {
            if (r.data)
              $scope.result = $sce.trustAsHtml(r.data);
            $scope.getreferences();
          }, function (r) {
            $scope.response = r;
            $timeout(function () {
              $scope.response = null;
            }, 15000);
          });
        $scope.getreferences();
      }
    };

    $scope.inquiry = function () {
      if ($scope.year && $scope.model.ethnic && $scope.model.level)
        $http.get($scope.url + 'inquiry&year=' + $scope.year.id + "&ethnic=" + $scope.model.ethnic.id + "&level=" + $scope.model.level.id)
          .then(function (r) {
            if (r.data.model) {
              $scope.model.total = r.data.model.total;
              $scope.model.women = r.data.model.women;
            }
          }, function (r) {
            $scope.response = r;
            $timeout(function () {
              $scope.response = null;
            }, 15000);
          });
    };

    $scope.save = function () {
      if ($scope.year && $scope.model) {
        $http.post($scope.url + 'save&year=' + $scope.year.id, {
          'Model': $scope.model,
          '_csrf': $('meta[name="csrf-token"]').attr("content")
        }).then(function (r) {
          $scope.model = null;
          $scope.response = r;
          $scope.enquiry();
          $timeout(function () {
            $scope.response = null;
          }, 15000);
        }, function (r) {
          $scope.response = r;
          $timeout(function () {
            $scope.response = null;
          }, 15000);
        });
      }
    };


    $scope.uploadedFile = function (element) {
      if (!$scope.issued_no) {
        $scope.files = null;
        alert('ກະລຸນາປ້ອນເລກທີ');
        return;
      }
      $scope.issued_date = $('#issued_date').val();
      if (!$scope.issued_date) {
        $scope.files = null;
        alert('ກະລຸນາປ້ອນວັນທີ');
        return;
      }

      $scope.$apply(function ($scope) {
        $scope.files = element.files;
        $http({
          url: $scope.url + "upload&year=" + $scope.year.id,
          method: "POST",
          processData: false,
          headers: {'Content-Type': undefined},
          data: {
            '_csrf': $('meta[name="csrf-token"]').attr("content"),
            'issued_no': $scope.issued_no,
            'issued_date': $scope.issued_date,
            'issued_by': $scope.issued_by
          },
          transformRequest: function (data) {
            var formData = new FormData();
            var file = $scope.files[0];
            formData.append("file_upload", file);
            angular.forEach(data, function (value, key) {
              formData.append(key, value);
            });
            return formData;
          }
        }).success(function (data, status, headers, config) {
          $scope.getreferences();
          $scope.issued_date = null;
          $scope.issued_no = null;
          $scope.issued_by = null;
          $("input[name='image'], #issued_date").val("");
          $scope.status = data.status;
          $scope.formdata = "";
        }).error(function (data, status, headers, config) {
          $scope.response = data;
          $timeout(function () {
            $scope.response = null;
          }, 15000);
        });
      });
    };

    $scope.getreferences = function () {
      if ($scope.year) {
        $http.get($scope.url + 'getreferences&year=' + $scope.year.id)
          .then(function (r) {
            if (r.data)
              $scope.references = r.data.files;
          }, function (r) {
            $scope.response = r;
            $timeout(function () {
              $scope.response = null;
            }, 15000);
          });
      }
    };

    $scope.deletefile = function (f) {
      if ($scope.year && f) {
        if (confirm('ທ່ານຕ້ອງການລຶບແທ້ບໍ?'))
          $http.post($scope.url + 'deletefile&year=' + $scope.year.id, {
            'id': f.id,
            '_csrf': $('meta[name="csrf-token"]').attr("content")
          }).then(function (r) {
            $scope.response = r;
            $scope.getreferences();
            $timeout(function () {
              $scope.response = null;
            }, 15000);
          }, function (r) {
            $scope.response = r;
            $timeout(function () {
              $scope.response = null;
            }, 15000);
          });
      }
    };
  });
</script>
<?php

namespace app\controllers;

use app\components\MyHelper;
use app\models\Attachment;
use app\models\Award;
use app\models\Menu;
use app\models\PhiscalYear;
use app\models\Province;
use app\models\StatVictoryoverseaProvince;
use app\models\StatVictoryoverseaProvinceDetail;
use Codeception\Util\HttpCode;
use Yii;
use yii\db\Exception;
use yii\web\Controller;

/**
 * StatVictoryoverseaProvinceController implements the CRUD actions for StatVictoryoverseaProvince model.
 */
class StatVictoryoverseaProvinceController extends Controller
{
    public $columns = [
        'free1_personal', 'free1_team',
        'free2_personal', 'free2_team',
        'free3_personal', 'free3_team',

        'revo1_personal', 'revo1_team',
        'revo2_personal', 'revo2_team',
        'revo3_personal', 'revo3_team',

        'labo1_personal', 'labo1_team',
        'labo2_personal', 'labo2_team',
        'labo3_personal', 'labo3_team',

        'deve1_personal', 'deve1_team',
        'deve2_personal', 'deve2_team',
        'deve3_personal', 'deve3_team',

        'frien_personal', 'frien_team'
    ];

    public $lables = ['ຫຼຽນໄຊອິດສະຫຼະ', 'ຫຼຽນໄຊປະຕິວັດຊະນະເລີດ', 'ຫຼຽນໄຊແຮງງານ', 'ຫຼຽນໄຊພັດທະນາ'];
    public $levels = ['ຊັ້ນ I', 'ຊັ້ນ II', 'ຊັ້ນ III'];

    public function actionIndex()
    {
        return $this->render('index', [
            'labels' => $this->lables,
            'levels' => $this->levels
        ]);
    }

<<<<<<< HEAD
    public function actionGet() {
    	
    	$user = Yii::$app->user->identity;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    			return;
    		}
    	}
=======
    public function actionGet()
    {
>>>>>>> 857e53e810e66f166149a2d70ea718d08a42ad3c
        $years = PhiscalYear::find()->where(['deleted' => 0])->asArray()->all();
        $awards = Award::find()->where(['deleted' => 0])->orderBy('position')->asArray()->all();
        $provinces = Province::find()->where(['deleted' => 0])->orderBy('province_code')->asArray()->all();

        return json_encode([
            'years' => $years,
            'awards' => $awards,
            'provinces' => $provinces
        ]);
    }

<<<<<<< HEAD
    public function actionEnquiry($year) {
    	$user = Yii::$app->user->identity;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    			return;
    		}
    	}
=======
    public function actionEnquiry($year)
    {
>>>>>>> 857e53e810e66f166149a2d70ea718d08a42ad3c
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }
        $models = StatVictoryoverseaProvinceDetail::find()->alias('d')
            ->select([
                'd.*',
                'province' => 'm.province_name',
                'award' => 'a.name'
            ])
            ->join('join', 'stat_victoryoversea_province t', 't.id=d.stat_victoryoversea_province_id and t.phiscal_year_id=:year', [':year' => $year->id])
            ->join('join', 'province m', 'm.id=d.province_id')
            ->join('join', 'award a', 'a.id=d.award_id')
            ->orderBy('m.province_code')
            ->asArray()->all();

        return json_encode([
            'models' => $models
        ]);
    }

<<<<<<< HEAD
    public function actionInquiry($year, $province, $award) {
    	$user = Yii::$app->user->identity;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    			return;
    		}
    	}
=======
    public function actionInquiry($year, $province, $award)
    {
>>>>>>> 857e53e810e66f166149a2d70ea718d08a42ad3c
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $model = StatVictoryoverseaProvinceDetail::find()->alias('d')
            ->join('join', 'stat_victoryoversea_province m', 'm.id = d.stat_victoryoversea_province_id and m.phiscal_year_id=:year', [':year' => $year->id])
            ->where([
                'award_id' => $award,
                'province_id' => $province,
            ])->asArray()->one();

        return json_encode(['model' => $model]);
    }

<<<<<<< HEAD
    public function actionSave($year) {
    	$user = Yii::$app->user->identity;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    			return;
    		}
    	}
=======
    public function actionSave($year)
    {
>>>>>>> 857e53e810e66f166149a2d70ea718d08a42ad3c
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $post = Yii::$app->request->post();
        if (isset($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model = StatVictoryoverseaProvince::find()->where(['phiscal_year_id' => $year->id])->one();
                if (!isset($model)) {
                    $model = new StatVictoryoverseaProvince();
                    $model->phiscal_year_id = $year->id;
                    $model->user_id = Yii::$app->user->id;
                }
                $model->last_update = date('Y-m-d H:i:s');
                $model->saved = 1;

                if (!$model->save()) throw new Exception(json_encode($model->errors));

                $detail = StatVictoryoverseaProvinceDetail::find()
                    ->where([
                        'stat_victoryoversea_province_id' => $model->id,
                        'province_id' => $post['Model']['province']['id'],
                        'award_id' => $post['Model']['award']['id'],
                    ])->one();
                if (!isset($detail)) {
                    $detail = new StatVictoryoverseaProvinceDetail();
                    $detail->province_id = $post['Model']['province']['id'];
                    $detail->award_id = $post['Model']['award']['id'];
                    $detail->stat_victoryoversea_province_id = $model->id;
                }
                $detail->attributes = $post['Model'];

                if (!$detail->save()) throw new Exception(json_encode($detail->errors));

                $transaction->commit();
            } catch (Exception $exception) {
                $transaction->rollBack();
                MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, $exception->getMessage());
                return;
            }
        }
    }

<<<<<<< HEAD
    public function actionPrint($year) {
    	
    	$user = Yii::$app->user->identity;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    			return;
    		}
    	}
=======
    public function actionPrint($year)
    {
>>>>>>> 857e53e810e66f166149a2d70ea718d08a42ad3c
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $models = StatVictoryoverseaProvinceDetail::find()->alias('d')
            ->select([
                'd.*',
                'province' => 'm.province_name',
                'award' => 'a.name'
            ])
            ->join('join', 'stat_victoryoversea_province t', 't.id=d.stat_victoryoversea_province_id and t.phiscal_year_id=:year', [':year' => $year->id])
            ->join('join', 'province m', 'm.id=d.province_id')
            ->join('join', 'award a', 'a.id=d.award_id')
            ->asArray()->all();


        return $this->renderPartial('../ministry/print', [
            'content' => $this->renderPartial('table', [
                'models' => $models,
                'year' => $year,
                'cols' => $this->columns,
                'labels' => $this->lables,
                'levels' => $this->levels,
            ])
        ]);
    }

<<<<<<< HEAD
    public function actionDownload($year) {
    	
    	$user = Yii::$app->user->identity;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    			return;
    		}
    	}
=======
    public function actionDownload($year)
    {
>>>>>>> 857e53e810e66f166149a2d70ea718d08a42ad3c
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }
        $models = StatVictoryoverseaProvinceDetail::find()->alias('d')
            ->select([
                'd.*',
                'province' => 'm.province_name',
                'award' => 'a.name'
            ])
            ->join('join', 'stat_victoryoversea_province t', 't.id=d.stat_victoryoversea_province_id and t.phiscal_year_id=:year', [':year' => $year->id])
            ->join('join', 'province m', 'm.id=d.province_id')
            ->join('join', 'award a', 'a.id=d.award_id')
            ->asArray()->all();

        return $this->renderPartial('../ministry/excel', [
            'file' => 'Victory Oversea Province ' . $year->year . '.xls',
            'content' => $this->renderPartial('table', [
                'models' => $models,
                'year' => $year,
                'cols' => $this->columns,
                'labels' => $this->lables,
                'levels' => $this->levels,
            ])
        ]);
    }

    public function actionUpload($year)
    {
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $post = Yii::$app->request->post();
        if (!isset($post)) {
            MyHelper::response(HttpCode::METHOD_NOT_ALLOWED, Yii::t('app', 'Incorrect Request'));
            return;
        }

        if (!isset($_FILES['file_upload'])) {
            MyHelper::response(HttpCode::METHOD_NOT_ALLOWED, Yii::t('app', 'Incorrect Request'));
            return;
        }

        $menu = Menu::find()->where(['table_name' => 'stat_victoryoversea_province'])->one();
        if (!isset($menu)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Data Not Found'));
            return;
        }


        $dir = 'upload/';
        if (!is_dir($dir)) mkdir($dir);
        $dir .= date('Y');
        if (!is_dir($dir)) mkdir($dir);

        $tmp_name = $_FILES['file_upload']['tmp_name'];
        $name = $_FILES['file_upload']['name'];
        $names = explode(".", $name);
        $ext = end($names);
        $filename = $menu->table_name . "_" . date('Y_m_d_His') . '.' . $ext;

        if (!move_uploaded_file($tmp_name, $dir . "/" . $filename)) {
            MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, "ພົບບັນຫາໃນການອັບໂຫຼດຟາຍ");
            return;
        }

        $model = new Attachment();
        $model->phiscal_year_id = $year->id;
        $model->menu_id = $menu->id;
        $model->user_id = Yii::$app->user->id;
        $model->deleted = 0;
        $model->name = $filename;
        $model->issued_no = $post['issued_no'];
        $model->issued_date = MyHelper::convertdatefordb($post['issued_date']);
        $model->issued_by = $post['issued_by'];
        $model->upload_date = date('Y-m-d H:i:s');
        $model->original_name = $name;
        $model->dir = date('Y');
        if (!$model->save()) {
            unlink($dir . "/" . $filename);
            MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, json_encode($model->errors));
            return;
        }
    }

    public function actionGetreferences($year)
    {
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $files = Attachment::find()->alias('a')
            ->join('join', 'menu m', 'm.id = a.menu_id and m.table_name=:table', [
                ':table' => 'stat_victoryoversea_province'
            ])
            ->where(['a.deleted' => 0, 'a.phiscal_year_id' => $year->id])
            ->orderBy('upload_date desc')
            ->asArray()->all();

        return json_encode([
            'files' => $files
        ]);
    }

    public function actionDeletefile($year)
    {
        $year = PhiscalYear::findOne($year);
        if (!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }
        if ($year->status != 'O') {
            MyHelper::response(HttpCode::METHOD_NOT_ALLOWED, "The year is not allow to input");
            return;
        }
        $post = Yii::$app->request->post();
        if (isset($post)) {
            $model = Attachment::findOne($post['id']);
            if (!isset($model)) {
                MyHelper::response(HttpCode::NOT_FOUND, "Data not found");
                return;
            }
            $model->deleted = 1;
            echo 'upload/' . $model->dir . '/' . $model->name;
            if (!is_dir('upload/' . $model->dir . '/backup')) mkdir('upload/' . $model->dir . '/backup');

            if (!copy('upload/' . $model->dir . '/' . $model->name, 'upload/' . $model->dir . '/backup/' . $model->name)) {
                MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, "Cannot move file");
                return;
            }

            if (!unlink('upload/' . $model->dir . '/' . $model->name)) {
                MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, "Cannot delete file");
                return;
            }

            if (!$model->save()) {
                MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, json_encode($model->errors));
                return;
            }
        }
    }
    
    public function beforeAction($action) {
    	$user = Yii::$app->user->identity;
    	$this->enableCsrfValidation = true;
    	$controller_id = Yii::$app->controller->id;
    	$acton_id = Yii::$app->controller->action->id;
    	if ($user->role ["name"] != Yii::$app->params ['DEFAULT_ADMIN_ROLE']) {
    		if (! AuthenticationService::isAccessibleAction ( $controller_id, $acton_id )) {
    			if (Yii::$app->request->isAjax) {
    				MyHelper::response ( HttpCode::UNAUTHORIZED, Yii::t ( 'app', 'HTTP Error 401- You are not authorized to access this operaton due to invalid authentication' ) . " with ID:  " . $controller_id . "/ " . $acton_id );
    				return;
    			} else {
    				return $this->redirect ( [
    						'authentication/notallowed'
    				] );
    			}
    		}
    	}
    
    	return parent::beforeAction ( $action );
    }
    
}

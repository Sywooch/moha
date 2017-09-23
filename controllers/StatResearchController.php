<?php

namespace app\controllers;

use app\components\MyHelper;
use app\models\PhiscalYear;
use app\models\StatResearchDetail;
use Codeception\Util\HttpCode;
use Yii;
use app\models\StatResearch;
use app\models\StatResearchSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatResearchController implements the CRUD actions for StatResearch model.
 */
class StatResearchController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGet() {
        $years = PhiscalYear::find()->where(['deleted' => 0])->asArray()->all();
        return json_encode([
            'years' => $years
        ]);
    }

    public function actionEnquiry($year) {
        $year = PhiscalYear::findOne($year);
        if(!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }
        $models = StatResearchDetail::find()->alias('d')
            ->select('d.*')
            ->addSelect([
                'start_date' => 'date(start_date)',
                'end_date' => 'date(end_date)',
            ])
            ->join('join', 'stat_research t', 't.id=d.stat_research_id and t.phiscal_year_id=:year', [':year'=> $year->id])
            ->asArray()->all();

        foreach ($models as $i => $model) {
            if(isset($model->start_date))
                $models[$i]['start_date'] = MyHelper::convertdatefordisplay($model->start_date);
            if(isset($model->end_date))
                $models[$i]['end_date'] = MyHelper::convertdatefordisplay($model->end_date);
        }

        return json_encode([
            'models' => $models
        ]);
    }

    public function actionSave($year) {
        $year = PhiscalYear::findOne($year);
        if(!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $post = Yii::$app->request->post();
        if(isset($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model = StatResearch::find()->where(['phiscal_year_id' => $year->id])->one();
                if (!isset($model)) {
                    $model = new StatResearch();
                    $model->phiscal_year_id = $year->id;
                    $model->user_id = Yii::$app->user->id;
                }
                $model->last_update = date('Y-m-d H:i:s');
                $model->saved = 1;

                if (!$model->save()) throw new Exception(json_encode($model->errors));

                $detail = isset($post['Model']['id'])? StatResearchDetail::findOne($post['Model']['id']):new StatResearchDetail();
                $detail->attributes = $post['Model'];
                $detail->start_date = MyHelper::convertdatefordb($detail->start_date);
                $detail->end_date = MyHelper::convertdatefordb($detail->end_date);
                $detail->stat_research_id = $model->id;
                if (!$detail->save()) throw new Exception(json_encode($detail->errors));

                $transaction->commit();
            } catch (Exception $exception) {
                $transaction->rollBack();
                MyHelper::response(HttpCode::INTERNAL_SERVER_ERROR, $exception->getMessage());
                return;
            }
        }
    }

    public function actionPrint($year) {
        $year = PhiscalYear::findOne($year);
        if(!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $models = StatResearchDetail::find()->alias('d')
            ->join('join', 'stat_research t', 't.id = d.stat_research_id and t.phiscal_year_id=:year', [':year' => $year->id])
            ->asArray()->all();

        return $this->renderPartial('../ministry/print', ['content' => $this->renderPartial('table', ['models' => $models, 'year' => $year])]);
    }

    public function actionDownload($year) {
        $year = PhiscalYear::findOne($year);
        if(!isset($year)) {
            MyHelper::response(HttpCode::NOT_FOUND, Yii::t('app', 'Incorrect Phiscal Year'));
            return;
        }

        $models = StatResearchDetail::find()->alias('d')
            ->join('join', 'stat_research t', 't.id = d.stat_research_id and t.phiscal_year_id=:year', [':year' => $year->id])
            ->asArray()->all();

        return $this->renderPartial('../ministry/excel', [
            'file' => 'Research '. $year->year . '.xls',
            'content' => $this->renderPartial('table', ['models' => $models, 'year' => $year])
        ]);
    }

    /**
     * Finds the StatResearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StatResearch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StatResearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
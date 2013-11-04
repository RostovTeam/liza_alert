<?php

class CrewController extends BaseAdminController
{

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionTest()
    {
        $c = Crew::model()->findByPk(1);
        var_dump($c->getAvailableVolunteers());
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Crew;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Crew']))
        {
            $model->attributes = $_POST['Crew'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Crew']))
        {
            $model->attributes = $_POST['Crew'];
            if ($model->save())
            {
                if (isset($_POST['Crew']['volunteer']) && is_array($_POST['Crew']['volunteer']))
                {
                    $vs = $model->volunteer;

                    if (is_array($vs))
                    {
                        $vs = array_merge($vs, $_POST['Crew']['volunteer']);
                    }
                    else
                    {
                        $vs = $_POST['Crew']['volunteer'];
                    }

                    $model->volunteer = $vs;
                    $model->save();
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new Crew('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Crew']))
            $model->attributes = $_GET['Crew'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Crew the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Crew::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Crew $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'crew-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

<?php

class VolunteerController extends BaseAdminController
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Volunteer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Volunteer']))
        {
            $model = Volunteer::create($_POST['Volunteer']);
            if ($model->id)
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

        if (isset($_POST['Volunteer']))
        {
            $model->attributes = $_POST['Volunteer'];
            if ($model->save())
            {
                if (isset($_POST['Volunteer']['crew']))
                {
                    foreach($_POST['Volunteer']['crew'] as $crew)
                    {
                        $vc= new VolunteerCrew;
                        
                        $vc->crew_id=$crew;
                        $vc->volunteer_id=$model->id;
                        $vc->save();
                    }
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
        $model = new Volunteer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Volunteer']))
            $model->attributes = $_GET['Volunteer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Volunteer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Volunteer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Volunteer $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'volunteer-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

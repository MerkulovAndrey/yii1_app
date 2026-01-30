<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return [
			'page'=>[
				'class'=>'CViewAction',
			],
		];
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Вывод страницы отчётов
	 */
	public function actionReport()
	{
		$data = [];
        $formModel = new ReportTopForm;

		if (isset($_REQUEST['ReportTopForm'])) {
			$formModel->year = $_REQUEST['ReportTopForm']['year'];
            if ($formModel->validate()) {
                $data = Author::model()->getReport($formModel->year);
            }
        }

        $this->render('report', [
            'report' => $data,
            'model' => $formModel
        ]);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',['model'=>$model]);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
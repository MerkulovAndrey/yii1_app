<?php

class ReportController extends Controller {
    public function actionIndex() {
        // Список отчётов
    }

    public function actionTopAuthors($year) {
        // Просмотр отчета
        return Author::model()
            ->with('books')
            ->findAllByAttributes(array('year' => $year))
            ->order('COUNT(books) DESC')
            ->limit(10);
    }
}
<?php
/**
 * ReportController класс построения отчётов
 */
class ReportController extends Controller {

    /**
     * Главная сраница отчётов
     */
    public function actionIndex() {
    }

    /**
     * Формирование отчёта
     * @param int $year
     * @return array результаты для построения отчёта
     */
    public function actionTopAuthors(int $year): array
    {
        // Просмотр отчета
        return Author::model()
            ->with('books')
            ->findAllByAttributes(array('year' => $year))
            ->order('COUNT(books) DESC')
            ->limit(10);
    }
}
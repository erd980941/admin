<?php
setlocale(LC_TIME, 'tr_TR.UTF-8');
require_once __DIR__.'/../_classes/order-statistic.class.php';
require_once __DIR__.'/../_helpers/chartsData.php';

$orderStatisticModel = new OrderStatistic();


$totalAmountAndCount = $orderStatisticModel->getTotalOrderAmountThisYear("Teslim Edildi", 2023);

$orderCounts = $orderStatisticModel->getOrderCountByMonthThisYear("Teslim Edildi", 2023);
$preparedData = prepareChartData($orderCounts);
$months = $preparedData['months'];
$sortedCountData = $preparedData['sortedCountData'];

$topSoldProducts=$orderStatisticModel->getTopFiveSoldProductsThisYear(2023);
$orderWaitingApproval=$orderStatisticModel->getOrderCountByStatus("Onay Bekliyor",2023);
$orderNotPaid=$orderStatisticModel->getOrderCountByNotPaymentStatus(2023);

?>


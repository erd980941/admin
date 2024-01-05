<?php 
function prepareChartData($orderCounts) {
    $months = [];
    $countData = [];

    $turkishMonths = [
        'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran',
        'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'
    ];

    // Veritabanından gelen verilerle bu dizileri doldur
    foreach ($orderCounts as $row) {
        $monthName = $turkishMonths[$row['order_month'] - 1]; // Türkçe ay adını al
        $months[] = $monthName; // Türkçe ay adını diziye ekle
        $countData[$monthName] = $row['order_count']; // Türkçe ay adına göre sipariş sayısını ekle
    }

    // Eksik ayları kontrol et ve varsa 0 sipariş olarak ekle
    $turkishAllMonths = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];

    foreach ($turkishAllMonths as $month) {
        if (!array_key_exists($month, $countData)) {
            $months[] = $month;
            $countData[$month] = 0;
        }
    }

    // Ay adlarına göre sırala
    // Ay isimlerini doğru sıraya getir
    usort($months, function ($a, $b) use ($turkishMonths) {
        return array_search($a, $turkishMonths) - array_search($b, $turkishMonths);
    });

    // Ay isimlerine göre $countData dizisini sırala
    $sortedCountData = [];
    foreach ($months as $month) {
        $sortedCountData[$month] = $countData[$month];
    }

    return ['months' => $months, 'sortedCountData' => $sortedCountData];
}
?>
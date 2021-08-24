$(document).ready(function () {
    let  translator = new I18n;
    let data_order = JSON.parse($('#chart_data').val()).order;
    let data_revenue = JSON.parse($('#chart_data').val()).revenue;
    let labels = [
        `${ translator.trans('partner.January')}`,
        `${ translator.trans('partner.February')}`,
        `${ translator.trans('partner.March')}`,
        `${ translator.trans('partner.April')}`,
        `${ translator.trans('partner.May')}`,
        `${ translator.trans('partner.June')}`,
        `${ translator.trans('partner.July')}`,
        `${ translator.trans('partner.August')}`,
        `${ translator.trans('partner.September')}`,
        `${ translator.trans('partner.October')}`,
        `${ translator.trans('partner.November')}`,
        `${ translator.trans('partner.December')}`,
    ];
    let areaRevenueOptions = {
        maintainAspectRatio: false,
        responsive: true,
        datasetFill: false,
        legend: {
            display: true
        }
    }

    let areaOrderData = {
        labels: labels,
        datasets: [
            {
                label: `${ translator.trans('partner.Orders')}`,
                backgroundColor: 'rgba(12,215,215,0.9)',
                data: data_order
            },
        ]
    }
    let areaRevenueData = {
        labels: labels,
        datasets: [
            {
                label: `${ translator.trans('partner.Revenues')}`,
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                data: data_revenue
            },
        ]
    }

    //- Order bar chart -
    //-------------
    let barChartCanvas = $('#order_chart').get(0).getContext('2d')
    let barChartData = $.extend(true, {}, areaOrderData)
    barChartData.datasets[0] = areaOrderData.datasets[0]

    let barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })

    //-------------
    //- Revenue line chart -
    //--------------
    let lineChartCanvas = $('#revenue_chart').get(0).getContext('2d')
    let lineChartOptions = $.extend(true, {}, areaRevenueOptions)
    let lineChartData = $.extend(true, {}, areaRevenueData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    let lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })
})

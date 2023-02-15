import {Chart, DoughnutController, ArcElement, Tooltip} from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(DoughnutController, ArcElement, Tooltip, ChartDataLabels);

const ELEMENTS_SELECTOR = {
    chartElement: '[data-chart]',
};

export default function () {
    $(ELEMENTS_SELECTOR.chartElement).each((id, chartItem) => {
        let data = $(chartItem).data('chart');
        let chartType = $(chartItem).data('chart-type');
        let baseOptions = {
            layout: {
                padding: 40
            },
            borderWidth: 2,
            aspectRatio: 1,
            plugins: {
                datalabels: {
                    formatter(value) {
                        return value === 0 ? '' : value.toLocaleString('ru-RU');
                    },
                    color: '#3A3A43',
                    anchor: 'end',
                    align: 'end',
                    offset: -1,
                    display: 'auto',
                },
                tooltip: {},
            }
        };

        if ($(chartItem).attr('data-chart-no-labels') != undefined) {
            baseOptions.plugins.datalabels.display = false;
            baseOptions.layout.padding = 0;
            baseOptions.borderWidth = 0;
        }

        if ($(chartItem).attr('data-chart-no-tooltip') != undefined) {
            baseOptions.plugins.tooltip.enabled = false;
        }

        if ($(chartItem).attr('data-calculator-chart') != undefined) {
            baseOptions.aspectRatio = 1.1
        }

        if (chartType === 'stats') {
            chartItem.myChart = new Chart(chartItem, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            data: data.datasets[0].data,
                            backgroundColor: function(context) {
                                const index = context.dataIndex;
                                const value = context.chart.data;
                                const label = value.labels.map((item, index) => {
                                    if (item === 'За покупки группы') {
                                        return '#945DAB'
                                    } else if (item === 'С личных покупок') {
                                        return '#2C877F'
                                    } else if (item === 'За приглашенных консультантов') {
                                        return '#D82F49'
                                    } else if (item === 'С товаров по персональной акции') {
                                        return '#C73C5E'
                                    } else if (item === 'За переход на К1') {
                                        return '#D26925'
                                    } else if (item === 'За переход на К2') {
                                        return '#C99308'
                                    } else if (item === 'За переход на К3') {
                                        return '#2D8859'
                                    } else if (item === 'За удержание на К3') {
                                        return '#3887B5'
                                    } else {
                                        return '#333'
                                    }
                                });
                                return label
                            },
                        }]},
                options: baseOptions,
            });
        } else {
            chartItem.myChart = new Chart(chartItem, {
                type: 'doughnut',
                data: data, 
                options: baseOptions,
            });
        }

       
    });
}
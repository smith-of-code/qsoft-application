import {Chart, DoughnutController, ArcElement, Tooltip} from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';
Chart.register(DoughnutController, ArcElement, Tooltip, ChartDataLabels);

const ELEMENTS_SELECTOR = {
    chartElement: '[data-chart]',
};

export default function () {
    $(ELEMENTS_SELECTOR.chartElement).each((id, chartItem)=>{
        let data = $(chartItem).data('chart');
        let baseOptions = {
            layout: {
                padding: 40
            },

            plugins: {
                datalabels: {
                    formatter: (value) => {
                        if (value == 0) {
                            return '';
                        }
                        return value.toLocaleString();
                    },
                    color: '#3A3A43',
                    anchor: 'end',
                    align: 'end',
                    offset: -2,
                    display: 'auto',
                },
                tooltip: {},
            }
        };

        if ($(chartItem).attr('data-chart-no-labels') != undefined) {
            baseOptions.plugins.datalabels.display = false;
            baseOptions.layout.padding = 0;
        }

        if ($(chartItem).attr('data-chart-no-tooltip') != undefined) {
            baseOptions.plugins.tooltip.enabled = false;
        }

        let myChart = new Chart(chartItem, {
            type: 'doughnut',
            data: data,
            options: baseOptions,
        });

        chartItem.myChart = myChart;
    });
}
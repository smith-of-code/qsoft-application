import {Chart, DoughnutController, ArcElement, Tooltip} from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(DoughnutController, ArcElement, Tooltip, ChartDataLabels);

const ELEMENTS_SELECTOR = {
    chartElement: '[data-chart]',
};

export default function () {
    $(ELEMENTS_SELECTOR.chartElement).each((id, chartItem) => {
        let data = $(chartItem).data('chart');
        let baseOptions = {
            layout: {
                padding: 40
            },
            borderWidth: 2,

            plugins: {
                datalabels: {
                    formatter(value) {
                        return value === 0 ? '' : value.toLocaleString();
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

        chartItem.myChart = new Chart(chartItem, {
            type: 'doughnut',
            data: data,
            options: baseOptions,
        });
    });
}
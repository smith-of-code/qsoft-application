import {Chart} from 'chart.js';


export default function () {
    const ctx = document.getElementById('myChart');

    const tags = ["Яндекс.Директ", "Google Ads", "Таргетированная реклама", "Партнеры"];

    const dataTraffic = {
        data: [1500, 400, 2000, 7000],
        backgroundColor: [
            '#3887b5',
            '#2c877f',
            '#d82f49',
            '#945dab',
        ],
        // borderColor: [
        //     'rgba(163,221,203,1)',
        //     'rgba(232,233,161,1)',
        //     'rgba(230,181,102,1)',
        //     'rgba(229,112,126,1)',
        // ],
        borderWidth: 0,
    };

    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: tags,
            datasets: [
                dataTraffic,
            ]
        },
    });
}
export default {
    methods: {
        formatNumber(number, useDecimals = false) {
            if (!number) return 0;
            if (useDecimals) {
                number = parseInt(number).toFixed(2);
            }
            return `${parseInt(number)}`.replace(/\d(?=(\d{3})+\.)/g, '$& ');
        },
    },
};

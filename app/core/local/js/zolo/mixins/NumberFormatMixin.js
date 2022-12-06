export default {
    methods: {
        formatNumber(number, useDecimals = false) {
            if (!number) return 0;
            let result = parseInt(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& ');
            return useDecimals ? result : result.substring(0, result.length - 3);
        },

        roundingNumber(number) {
            if (!number) return 0;
            let result = Math.round(parseFloat(number));
            return result;
        },
    },
};

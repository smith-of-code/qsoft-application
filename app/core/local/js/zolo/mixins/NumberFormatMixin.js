export default {
    methods: {
        formatNumber(number, useDecimals = false) {
            if (!number) return 0;
            number = Math.round(parseFloat(number));
            let result = number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&\u00A0');
            return useDecimals ? result : result.substring(0, result.length - 3);
        },
    },
};

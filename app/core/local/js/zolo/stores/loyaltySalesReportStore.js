import { defineStore } from 'ui.vue3.pinia';

export const useLoyaltySalesReportStore = defineStore('loyaltySalesReport', {
    actions: {
        async getDataByPeriod(from, to) {
            return await BX.ajax.runComponentAction('zolo:loyalty.sales.report', 'getDataByPeriod', {
                mode: 'class',
                data: { from, to },
            });
        },
        async getTeamMembersDataByPeriod(role, from, to) {
            return await BX.ajax.runComponentAction('zolo:loyalty.sales.report', 'getTeamMembersDataByPeriod', {
                mode: 'class',
                data: { role, from, to },
            });
        },
    },
})
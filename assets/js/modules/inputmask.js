import Inputmask from "inputmask";

const ELEMENTS_SELECTOR = {
    date: '[data-mask-date]',
};

export default function () {
    let dates = document.querySelectorAll(ELEMENTS_SELECTOR.date);
    new Inputmask("dd.mm.yyyy").mask(dates);
}
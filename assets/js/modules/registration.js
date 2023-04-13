import validation from './validation';
import {nextStepIndicator, prevStepIndicator} from './steps';

const ELEMENTS_SELECTOR = {
    next: ['[data-registration-next]'],
    prev: ['[data-registration-prev]'],
};


export default function () {
    // $(document).on('submit', ELEMENTS_SELECTOR.next, function(e) {
    //     e.preventDefault();

    //     nextStepIndicator();
    // });

    // $(document).on('click', ELEMENTS_SELECTOR.prev, function(e) {
    //     e.preventDefault();

    //     prevStepIndicator();
    // });
}
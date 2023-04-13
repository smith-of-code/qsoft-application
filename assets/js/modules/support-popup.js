 import scrollbar from './scrollbar';
 import inputRepalece from './inputReplace';
 import inputMaskInit from "./inputmask";
 import initSelect from "./select";
 import dropzone from './dropzone';

 export default function showSupportPopup() {
     $('[data-src="/ajax/popup/popup-support.php"]').on('click', function () {
         setTimeout(() => {
             initSelect();
             inputRepalece();
             inputMaskInit();
             scrollbar();
             dropzone();
         }, 500);
     })
 }

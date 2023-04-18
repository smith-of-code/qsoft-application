/**
 * @fileoverview dragscroll - scroll area by dragging
 * @version 0.0.8
 * 
 * @license MIT, see http://github.com/asvd/dragscroll
 * @copyright 2015 asvd <heliosframework@gmail.com> 
 */

const _window = window;
const _document = document;
const mousemove = 'mousemove';
const mouseup = 'mouseup';
const mousedown = 'mousedown';
const EventListener = 'EventListener';
const addEventListener = 'add'+EventListener;
const removeEventListener = 'remove'+EventListener;
let newScrollX, newScrollY;

let dragged = [];
const reset = function(i, el) {
    for (i = 0; i < dragged.length;) {
        el = dragged[i++];
        el = el.container || el;
        el[removeEventListener](mousedown, el.md, 0);
        _window[removeEventListener](mouseup, el.mu, 0);
        _window[removeEventListener](mousemove, el.mm, 0);
    }

    // cloning into array since HTMLCollection is updated dynamically
    dragged = [].slice.call(_document.getElementsByClassName('dragscroll'));
    for (i = 0; i < dragged.length;) {
        (function(el, lastClientX, lastClientY, pushed, scroller, cont){
            (cont = el.container || el)[addEventListener](
                mousedown,
                cont.md = function(e) {
                    if (!el.hasAttribute('nochilddrag') ||
                        _document.elementFromPoint(
                            e.pageX, e.pageY
                        ) == cont
                    ) {
                        pushed = 1;
                        lastClientX = e.clientX;
                        lastClientY = e.clientY;

                        e.preventDefault();
                    }
                }, 0
            );

            _window[addEventListener](
                mouseup, cont.mu = function() {pushed = 0;}, 0
            );

            _window[addEventListener](
                mousemove,
                cont.mm = function(e) {
                    if (pushed) {
                        (scroller = el.scroller||el).scrollLeft -=
                            newScrollX = (- lastClientX + (lastClientX=e.clientX));
                        scroller.scrollTop -=
                            newScrollY = (- lastClientY + (lastClientY=e.clientY));
                        if (el == _document.body) {
                            (scroller = _document.documentElement).scrollLeft -= newScrollX;
                            scroller.scrollTop -= newScrollY;
                        }
                    }
                }, 0
            );
        })(dragged[i++]);
    }
}


if (_document.readyState == 'complete') {
    reset();
} else {
    _window[addEventListener]('load', reset, 0);
}



export default reset






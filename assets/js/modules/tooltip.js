import tippy from 'tippy.js';

export default function tooltip() {
    const html = $('[data-tippy-html]');
    html.each(function(id, item) {
        let template = $(item).find('[data-tippy-template]');

        tippy(item, {
            theme: 'light',
            arrow: false,
            appendTo: 'parent',
            content: template[0].innerHTML,
            allowHTML: true,
        });
    });

    setTimeout(() => {
        let block = $('[data-tippy-content]');
        
        block.each(function(index, item) {

            let attrLength = $(item).attr('data-tippy-content').length

            if (attrLength > 0) {
                tippy(item, {
                    theme: 'light',
                    arrow: false,
                    appendTo: 'parent',
                    onShown(instance) {
                        instance.enable();
                        instance.setProps({
                            duration: 10,
                          });
                        const tippyElement = instance.reference
                        const elementAttr = $(tippyElement).attr('data-tippy-content');
                        if (elementAttr) {
                            instance.setContent(elementAttr);
                        }
                        return
                      },
                    
                });
            } else {
                return
            } 
        })
    }, 500);

    window.tippy = tippy;
}
const ID = {
    bitrix: '#bx-panel',
    expaner: '#bx-panel-expander',
    hider: '#bx-panel-hider',
};

const CLASS = {
    fixed: 'bx-panel-fixed',
};

export default function () {
    const bitrixPanel = document.querySelector(ID.bitrix);

    if (!bitrixPanel) return;

    const expander = bitrixPanel.querySelector(ID.expaner);
    const hider = bitrixPanel.querySelector(ID.hider);

    document.querySelector('body').style.paddingTop = `${bitrixPanel.offsetHeight}px`;
    document.querySelector('[data-dropdown-block]').style.top = `${bitrixPanel.offsetHeight}px`;
    bitrixPanel.classList.add(CLASS.fixed);

    [expander, hider].forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelector('body').style.paddingTop = `${bitrixPanel.offsetHeight}px`;
            document.querySelector('[data-dropdown-block]').style.top = `${bitrixPanel.offsetHeight}px`;
        });
    });
};

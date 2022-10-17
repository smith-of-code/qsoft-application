const ID = {
    bitrix: '#bx-panel',
};

const CLASS = {
    fixed: 'bx-panel-fixed',
};

export default function () {
    const bitrixPanel = document.querySelector(ID.bitrix);

    if (!bitrixPanel) return;

    document.querySelector('body').style.paddingTop = `${bitrixPanel.offsetHeight}px`;
    bitrixPanel.classList.add(CLASS.fixed);
};

const ID = {
    bitrix: '#bx-panel',
};

export default function () {
    const bitrixPanel = document.querySelector(ID.bitrix);

    if (bitrixPanel) return;

    document.querySelector('body').style.paddingTop = `${bitrixPanel.offsetHeight}px`;
};

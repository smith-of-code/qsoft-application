let form = document.querySelector('#subscribe__form')
form.addEventListener('submit',async (event)=>{
    event.preventDefault()
    console.log(form)

    const chanel = location.pathname === '/info/ame-business'?3:2
    const email = form.email.value

    let url = `/info/ame-business?email=${email}&chanel=${chanel}`


    let response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
    });
    let result = await response.json()
    form.style.display = 'none'
    document.querySelector('.subscribe__left-head').innerHTML = 'Спасибо за подписку!'
    document.querySelector('.subscribe__left-text').innerHTML = 'Мы сообщим Вам о запуске проекта amestore.ru!'
})



let changeLangBtn = document.querySelectorAll('.indev__lang-item')

if (localStorage.getItem('plagLang')){
    document.querySelectorAll('.root-container').forEach(e=>{
        if (e.dataset.lang !== localStorage.getItem('plagLang')){
            e.classList.remove('active')
        }else {
            e.classList.add('active')
        }


    })
}


changeLangBtn.forEach(e=>{
    e.addEventListener('click',(event)=>{
        if (!event.target.classList.contains('active')){
            document.querySelectorAll('.root-container').forEach(e=>{
                e.classList.toggle('active')
            })
        }

        localStorage.setItem('plagLang',event.target.dataset.lang)
    })
})

const clickValue = 1

$(document).ready(() => {

    setInterval(() => {

        $('#clicks').load('upload-clicks.php', {

            username: user.username,
            clicks: user.clicks
        })

    }, 1000 * 20)
})

window.onbeforeunload = function(event) {

    let data = new FormData()
    data.append('username', String(user.username))
    data.append('clicks', String(user.clicks))

    navigator.sendBeacon('upload-clicks.php', data)
}

async function delay(time) {

	return await new Promise(resolve => setTimeout(resolve, time))
}

async function moustacheClick() {

    let moustache = document.getElementById('moustache')
    let clicksDisplay = document.getElementById('clicks')

	moustache.style.transform = `scale(120%) rotate(${(Math.random() * 8) - 4}deg)`
    await delay(100)
    moustache.style.transform = ''

    user.clicks += clickValue

    clicksDisplay.innerHTML = user.clicks

    // let boom = new Audio('audio/boom.mp3')
    // boom.play()
}

// async function spin() {

//     while (true) {

//         moustache.style.transitionDuration = '1s'
//         moustache.style.transform = `rotate(360deg)`
//         await delay(1000)
//         moustache.style.transitionDuration = '0s'
//         moustache.style.transform = ''
//         await delay(1000)
//         moustache.style.transitionDuration = ''
//     }
// }

// spin()

const clickValue = 1

$(document).ready(() => {

    setInterval(() => {

        $('#clicks').load('upload-clicks.php', {

            username: user.username,
            clicks: user.clicks
        })

    }, 1000 * 60)
})

async function delay(time) {

	return await new Promise(resolve => setTimeout(resolve, time))
}

function mute(buttonId, audioId) {

    let button = document.getElementById(buttonId)
    let audio = document.getElementById(audioId)

    if (audio.paused) {

        button.src = 'images/sound/music_unmute.svg'
        audio.play()

    } else {

        button.src = 'images/sound/music_mute.svg'
        audio.pause()
    }
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
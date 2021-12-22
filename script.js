
user.clickValue = calculateClickValue(user.clicker)
user.upgradeCost = calculateClickUpgradeCost(user.clicker)

refreshClickerData(user)

function calculateClickValue(level) {

    return Math.floor((level ** 3/2) + level + 1)
}

function calculateClickUpgradeCost(level) {

    return Math.floor(((6 * level) ** 3/2) + 20)
}

function refreshClickerData(user) {

    $('#level').html(user.clicker.toLocaleString())
    $('#value').html(user.clickValue.toLocaleString())
    $('#cost').html(user.upgradeCost.toLocaleString())
}

function uploadData(user) {

    $('#points').load('upload-clicks.php', {

        username: user.username,
        clicks: user.clicks,
        points: user.points,
        clicker: user.clicker
    })
}

$(document).ready(() => {

    $('#moustache').click(async () => {

        let moustache = document.getElementById('moustache')
        let clicksDisplay = document.getElementById('points')

        moustache.style.transform = `scale(120%) rotate(${(Math.random() * 8) - 4}deg)`
        await delay(100)
        moustache.style.transform = ''

        user.clicks ++
        user.points += user.clickValue

        clicksDisplay.innerHTML = (user.points).toLocaleString()

        // let boom = new Audio('audio/boom.mp3')
        // boom.play()
    })

    $('#clicker').click(() => {

        if (user.points >= user.upgradeCost && user.clicker < 1000) {

            user.points -= user.upgradeCost
            user.clicker ++
            user.clickValue = calculateClickValue(user.clicker)
            user.upgradeCost = calculateClickUpgradeCost(user.clicker)

            uploadData(user)
        }

        refreshClickerData(user)
    })

    setInterval(() => {

        uploadData(user)

    }, 1000 * 20)
})

window.onbeforeunload = function(event) {

    let data = new FormData()
    data.append('username', String(user.username))
    data.append('clicks', String(user.clicks))
    data.append('points', String(user.points))
    data.append('clicker', String(user.clicker))

    navigator.sendBeacon('upload-clicks.php', data)
}

async function delay(time) {

	return await new Promise(resolve => setTimeout(resolve, time))
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
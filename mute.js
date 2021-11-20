
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
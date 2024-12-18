
const video = document.querySelector('video');
const play = document.querySelector('.play-pause .play');
const pause = document.querySelector('.play-pause .pause');
const fullScreen = document.querySelector('.screen-size .full');
const minimizedScreen = document.querySelector('.screen-size .minimized');
const watchedTime = document.querySelector('.progress-bar .watched-time');
const circle = document.querySelector('.progress-bar .circle');
const progressBar = document.querySelector('.progress-bar');
const volumeUp = document.querySelector('.volume .up');
const volumeMuted = document.querySelector('.volume .muted');
const controlsBar = document.querySelector('.bottom__video-control');

//Play & Pause 
function playPause() {
    if(video.paused) {
        video.play();
        play.style.display = "none";
        pause.style.display = "block";
    } else {
        video.pause();
        play.style.display = "block";
        pause.style.display = "none";            
    }
}

//Change screen size fullscreen/minimized
function changeScreenSize() {
    if(document.fullscreenElement) {     
        document.exitFullscreen();
        fullScreen.style.display = "block";
        minimizedScreen.style.display = "none";  
    } else {        
        document.documentElement.requestFullscreen();
        fullScreen.style.display = "none";
        minimizedScreen.style.display = "block";
    }
}


function forward() {
    video.currentTime += 10;
}

function back() {
    video.currentTime -= 10;
}

function volume() {
    if(video.muted) {
        video.muted = false;
        volumeUp.style.display = "block";
        volumeMuted.style.display = "none"; 
    } else {
        video.muted = true;
        volumeUp.style.display = "none";
        volumeMuted.style.display = "block"; 
    }
}

//Calculate watched time
video.addEventListener('timeupdate', () => {
    watchedTime.style.width = ((video.currentTime  / video.duration) * 100) + "%";    
})

progressBar.addEventListener('click', (e) => {
    let target = (e.pageX - progressBar.offsetLeft) / progressBar.offsetWidth;    
    video.currentTime = (target * video.duration) ; 
})

//Shortcuts
document.addEventListener('keyup', (e) => {
    if(e.keyCode === 32)
        playPause();

    if(e.keyCode === 37)
        back();

    if(e.keyCode === 39)
        forward();

    if(e.keyCode === 70)
        changeScreenSize();

    if(e.keyCode === 77)
        volume();

    showControls();
})

// Hide controls bar after 5 seconds
let controlsTimeout;
function showControls() {        
    //clearInterval(controlsTimeout);
    controlsBar.style.opacity = "1";
    hideControls();
}

function hideControls() {
    if(video.played) {
        controlsTimeout = setTimeout(() => {
            controlsBar.style.opacity = "0";
        }, 5000);
    }  
}

document.addEventListener('mousemove', () => {
    showControls();
})
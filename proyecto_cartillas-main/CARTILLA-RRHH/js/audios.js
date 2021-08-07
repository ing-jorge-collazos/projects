function playAudioEng(){
    var audioEng =document.getElementById("audioEng");
    audioEng.setAttribute("controls","controls");
    audioEng.setAttribute("controlslist","nodownload");
    audioEng.style.display="block";
    if(audioEng.paused){
        audioEng.play();
    }else{
        audioEng.pause();
    }
    
    var audioSpa =document.getElementById("audioSpa");
    audioSpa.removeAttribute("controls");
    audioSpa.style.display="none";
    audioSpa.pause();
    audioSpa.currentTime=0;
}

function playAudioSpa(){
    var audioSpa =document.getElementById("audioSpa");
    audioSpa.setAttribute("controls","controls");
    audioSpa.setAttribute("controlslist","nodownload");
    audioSpa.style.display="block";
    if(audioSpa.paused){
        audioSpa.play();
    }else{
        audioSpa.pause();
    }
    
    var audioEng =document.getElementById("audioEng");
    audioEng.removeAttribute("controls");
    audioEng.style.display="none";
    audioEng.pause();
    audioEng.currentTime = 0;
}
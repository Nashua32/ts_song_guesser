let beginning = -1.0;

function sleep(ms) {
    return new Promise(
      resolve => setTimeout(resolve, ms)
    );
  }

function playGivenTimeFirst() {
    try {
        if(document.getElementById("audId"))
            return;
    }
    catch {}
    music = new Audio(sessionStorage.songpath);
    music.id = "audId";
    music.preload = "auto";
    document.body.appendChild(music);
    document.getElementById("playbutton").innerHTML = "loading";

    music.secondsLoadedFrom = function(pos) { // hány mp van bufferelve pos mptől kezdve
        if(pos < 0)
            pos = 0;
        for(let i = 0; i < this.buffered.length; ++i) { // .buffered egy furán indexelt array: https://developer.mozilla.org/en-US/docs/Web/API/TimeRanges#normalized_timeranges_objects=
            if(this.buffered.start(i) > pos)
                return 0; // .buffered rendezett
            let loaded = this.buffered.end(i) - pos;
            if(loaded >= 0)
                return loaded;
        }
        return 0;
    }

    music.addEventListener('loadedmetadata', function() {
        if(this.randomStart !== undefined)
            return; // valamiért nem csak egyszer tölti be a metadatát, hanem seekeknél is
        if (beginning === -1) {
            this.randomStart = Math.random() * (this.duration - sessionStorage.playtime);
            beginning = this.randomStart;
        }
        else
            this.randomStart = beginning;
        console.log("Seeking from " + this.currentTime + " to " + this.randomStart);
        this.currentTime = this.randomStart;
    });

    let tryToPlay = async function() { // sleep miatt async. idiot
        if(this.readyState < HTMLAudioElement.HAVE_CURRENT_DATA)
            return; // metadata progress is progress
        if(this.started)
            return;

        let loaded = this.secondsLoadedFrom(this.randomStart);
        console.log("loaded " + loaded + " from " + this.randomStart);
        if(loaded < sessionStorage.playtime) { // nem töltött be a lejátszandó rész végéig
            this.currentTime = this.randomStart + loaded; // előretekerünk hogy betöltsön mindent
            console.log(this.currentTime);
            return;
        }
        this.currentTime = this.randomStart;
        console.log("start:" + this.randomStart);
        console.log("current time:" + this.currentTime);
        this.started = true; // ez az event (async miatt?) elindulhat újra mielőtt vége lenne
        console.log("playing");
        document.getElementById("playbutton").innerHTML = "playing"
        this.play();
        await sleep(1000 * sessionStorage.playtime)
        this.pause();
        document.getElementById("playbutton").innerHTML = "play music"
        document.body.removeChild(this);
    }

    // canplaythrough listener lenne az okos módszer de nem bízom a böngészőben
    // https://developer.mozilla.org/en-US/docs/Web/API/HTMLMediaElement/canplaythrough_event
    music.addEventListener('progress', tryToPlay);
    music.addEventListener('canplay', tryToPlay); // ha az fájl cachelve van 50% hogy a loadedmetadata event után nem lesz progress, viszont olyankor is lesz utána canplay
}

let music = new Audio(sessionStorage.songpath);

document.getElementById("playbutton").onclick = function(){
    playGivenTimeFirst();
}

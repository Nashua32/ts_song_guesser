//albumok listáját mentjük
let div = document.getElementById("getAlbumslistFromHere");
let temp = div.textContent;
console.log(temp);
let albumList = [];
let tempstr = "";
for (let i=0; i<temp.length; i++) {
    if (temp[i]==='-') {
        albumList.push(tempstr);
        tempstr = "";
    }
    else if (temp[i] !== ' ')  
        tempstr = tempstr.concat(temp[i]);
}
for (let i=0; i<albumList.length; i++)
    console.log(albumList[i]);

//dalok listáját mentjük
div = document.getElementById("getSonglistFromHere");
temp = div.textContent;
let songList = []; //dalok neve, benne elérési útvonal is!
tempstr="";
for (let i=0; i<temp.length; i++) {
    if (temp[i]==='#') {
        songList.push(tempstr);
        tempstr = "";
    }
    else  
        tempstr = tempstr.concat(temp[i]);
}
for (let i=0; i<songList.length; i++)
    console.log(songList[i]);

//beállított időt mentjük
div = document.getElementById("getTimeFromHere");
let seconds_to_play = div.textContent;

//adott szám path-ét mentjük, ez lehet nem kell
div = document.getElementById("getTitleFromHere");
let path = div.textContent;


console.log(path);
console.log(seconds_to_play);

if (sessionStorage.albums === "-1") {
    sessionStorage.albums = JSON.stringify(albumList);
}
if (sessionStorage.songs === "-1") {
    sessionStorage.songs = JSON.stringify(songList);
}
if (sessionStorage.playtime === "-1") {
    sessionStorage.playtime = parseFloat(seconds_to_play);
}
if (sessionStorage.songpath === "none") {
    sessionStorage.songpath = path;
}
console.log(sessionStorage.playtime);
console.log(sessionStorage.albums);
console.log(sessionStorage.songpath);

function newSong() {
    songList = JSON.parse(sessionStorage.songs);
    temp = songList[Math.floor(Math.random() * songList.length)];
    sessionStorage.songpath = temp;
    console.log("hellooooo");
    sessionStorage.songtitle = "Title will be revealed here...";
    window.location = window.location.href;
    window.location.reload(true);
}
   

document.getElementById("selectedTimeDisplay").innerHTML = sessionStorage.playtime + " seconds";
temp = "";
let templist = JSON.parse(sessionStorage.albums);
console.log(sessionStorage.albums);
console.log("bro");
templist[0] = templist[0].substr(1);
console.log(templist);
for (let i=0; i<templist.length; i++) {
    switch (templist[i]) {
        case "ts":
            temp = temp.concat("Taylor Swift - Debut album");
            break;
        case "fearless":
            temp = temp.concat("Fearless");
            break;
        case "sn":
            temp = temp.concat("Speak Now");
            break;
        case "red":
            temp = temp.concat("Red");
            break;
        case "1989":
            temp = temp.concat("1989");
            break;
        case "rep":
            temp = temp.concat("Reputation");
            break;
        case "lover":
            temp = temp.concat("Lover");
            break;
        case "folk":
            temp = temp.concat("Folklore");
            break;
        case "em":
            temp = temp.concat("Evermore");
            break;
    }
    if (i!= templist.length-1)
        temp = temp.concat(", ");
}
console.log(temp);
document.getElementById("selectedAlbumsDisplay").innerHTML = temp;
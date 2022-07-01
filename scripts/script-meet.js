
/*
userType = document.getElementById("userType").innerHTML+"";
m = false;

if(userType == "suporte"){
    m = true;
} else {
    m = false;
}


const domain = 'meet.jit.si';
const options = {
    roomName: document.title,
    width: 700,
    height: 700,
    parentNode: document.querySelector('#meet'),
    lang: 'pt-br',
};




api = new JitsiMeetExternalAPI(domain, options);
*/
/*

var participantLeft_function = function () {
    updateLobby();
    lobbys[document.title] = 'Disponivel';
    SendStatusButton(lobbys);
    confirm("participante saiu");
    console.log(api.getParticipantsInfo());

}

var participantJoinned_function = function () {
    updateLobby();
    lobbys[document.title] = 'Ocupado';
    SendStatusButton(lobbys);
    confirm("participante entrou");
    console.log("Participantes" + api.getParticipantsInfo());
}

var participantJoinnedLocal_function = function (object) {
    updateLobby();

    lobbys[document.title] = 'Disponivel';
    SendStatusButton(lobbys);

}

var participantLeftLocal_function = function (object) {
    updateLobby();
    lobbys[document.title] = 'Indisponivel';
    SendStatusButton(lobbys);

}


var readyToClose = function (object) {
    //confirm("Fechando")
}

var participantLeft = function (object) {
    //confirm("Fechando")
    if(m){
        window.location.href = "http://localhost/lobby-reunioes/suporte/dashboard.php";
    }

}


api.addListener("readyToClose", readyToClose);

api.addListener("participantLeft", participantLeft);


api.addListener("videoConferenceJoined", participantJoinnedLocal_function);
api.addListener("videoConferenceLeft", participantLeftLocal_function);


api.addListener("participantJoined", participantJoinned_function);
api.addListener("participantLeft", participantLeft_function);

*/
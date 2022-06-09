

const domain = 'meet.jit.si';
const options = {
    roomName: 'Lobby-1',
    width: 700,
    height: 700,
    parentNode: document.querySelector('#meet'),
    lang: 'pt-br'
};
api = new JitsiMeetExternalAPI(domain, options);

api.executeCommands({
    displayName: ['nickname'],
    toggleAudio: []
});


var lobbys = {
    Lobby_1: 'Disponivel',
    Lobby_2: 'Indisponivel',
    Lobby_3: 'Indisponivel',
    Lobby_4: 'Indisponivel',
}

function inic() {
    let request = new XMLHttpRequest()
    request.open("POST", "http://localhost/lobby-reunioes/put.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(lobbys));
    request.onload = function () {
        //confirm(this.responseText);
    }
}

var SendStatusButton = function (object) {
    let request = new XMLHttpRequest()
    request.open("POST", "http://localhost/lobby-reunioes/put.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(object));
    request.onload = function () {
        //confirm(this.responseText);
    }
};

var participantLeft_function = function () {
    lobbys['Lobby_1'] = 'Disponivel';
    SendStatusButton(lobbys);
    confirm("participante saiu");
    console.log(api.getParticipantsInfo());

}

var participantJoinned_function = function () {
    lobbys['Lobby_1'] = 'Ocupado';
    SendStatusButton(lobbys);
    confirm("participante entrou");
    console.log("Participantes" + api.getParticipantsInfo());
}

var participantJoinnedLocal_function = function (object) {
    console.log("Participante Local:" + object["id"]);
    api.executeCommand('grantModerator',
        { participantID: [object["id"]] }
    );


    lobbys['Lobby_1'] = 'Disponivel';
    SendStatusButton(lobbys);

}

var participantLeftLocal_function = function (object) {

    lobbys['Lobby_1'] = 'Indisponivel';
    SendStatusButton(lobbys);

}

api.addListener("videoConferenceJoined", participantJoinnedLocal_function);
api.addListener("videoConferenceLeft", participantLeftLocal_function);


api.addListener("participantJoined", participantJoinned_function);
api.addListener("participantLeft", participantLeft_function);


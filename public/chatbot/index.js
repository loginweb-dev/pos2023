const { Client, Location, List, Buttons, LocalAuth} = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
var qr = require('qr-image');
var path = require('path');
require('dotenv').config()
const axios = require('axios');



const { Configuration, OpenAIApi } = require("openai");
const { forEach } = require("lodash");
const configuration = new Configuration({
    apiKey: process.env.OPENAI_API_KEY,
  });
const openai = new OpenAIApi(configuration);

// const client = new Client({
//     authStrategy: new LocalAuth({
//         clientId: 'client'+process.env.NEGOCIO2
//     }),
//     puppeteer: {
//         executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
//         // MacOS: /Applications/Google Chrome.app/Contents/MacOS/Google Chrome
//         // Linux: /usr/bin/google-chrome-stabl
//     },
//     // PARA LA WEB
//     // puppeteer: {
//     //     headless: true,
//     //     ignoreDefaultArgs: ['--disable-extensions'],
//     //     args: ['--no-sandbox']
//     // }
// });

// client.initialize();


// client.on('message', async msg => {
//    // console.log('MESSAGE RECEIVED', msg);
// });


// client.on('loading_screen', (percent, message) => {
//     console.log('LOADING SCREEN', percent, message);
// });

// var micount = 0
// client.on('qr', (qr) => {
//     // NOTE: This event will not be fired if a session is specified.
//     console.log('QR RECEIVED', qr);
//     qrcode.generate(qr, {small: true}, function (qrcode) {
//         console.log(qrcode)
//         console.log('Nuevo QR, recuerde que se genera cada 1 minuto, INTENTO #'+micount++)        
//     })
// });

// client.on('authenticated', () => {
//     console.log('AUTHENTICATED');
// });

// client.on('auth_failure', msg => {
//     // Fired if session restore was unsuccessful
//     console.error('AUTHENTICATION FAILURE', msg);
// });

// client.on('ready', () => {
//     console.log('READY');
// });


// client.on('group_join', (notification) => {
//     // User has joined or been added to the group.
//     console.log('join', notification.id.participant);
//     console.log('-------------------------------------');
//     // notification.reply('User joined.');
// });

// client.on('group_leave', (notification) => {
//     // User has left or been kicked from the group.
//     console.log('leave', notification.id.participant);
//     console.log('-------------------------------------');
//     notification.reply('otro mas que abandona el grupo.');
// });

// client.on('group_update', (notification) => {
//     // Group picture, subject or description has been updated.
//     console.log('update', notification);
// });

// client.on('change_state', state => {
//     console.log('CHANGE STATE', state );
// });

// // Change to false if you don't want to reject incoming calls
// let rejectCalls = true;

// client.on('call', async (call) => {
//     console.log('Call received, rejecting. GOTO Line 261 to disable', call);
//     if (rejectCalls) await call.reject();
//     await client.sendMessage(call.from, `[${call.fromMe ? 'Outgoing' : 'Incoming'}] Phone call from ${call.from}, type ${call.isGroup ? 'group' : ''} ${call.isVideo ? 'video' : 'audio'} call. ${rejectCalls ? 'This call was automatically rejected by the script.' : ''}`);
// });

// client.on('disconnected', (reason) => {
//     console.log('Client was logged out', reason);
// });




//----------------------------------------------------
const client2 = new Client({
    authStrategy: new LocalAuth({
        clientId: 'client'+process.env.NEGOCIO3
    }),
    puppeteer: {
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        // MacOS: /Applications/Google Chrome.app/Contents/MacOS/Google Chrome
        // Linux: /usr/bin/google-chrome-stable
    },
    // PARA LA WEB
    // puppeteer: {
    //     headless: true,
    //     ignoreDefaultArgs: ['--disable-extensions'],
    //     args: ['--no-sandbox']
    // }
});

client2.initialize();
const historial2 = []
client2.on('message', async msg => {
  

   let chat = await msg.getChat();
   const contact = await msg.getContact();
   if (chat.isGroup) {
    //    let newSubject = msg.body.slice(9);
    //    chat.setSubject(newSubject);
     // console.log(msg)
   } else {
    const isBroadcast = msg.broadcast || msg.isStatus;
    if (isBroadcast || (msg.from == "status@broadcast")) {
        // console.log(msg)
    }else{
        // var midata = await axios("http://localhost:8000/api/chatbots/get/"+msg.from)
        // console.log(midata.data.length)
        // if (midata.data.length === 0) {
        //     var customer = contact.name ? contact.name : contact.pushname
        //     var mipront = "[INSTRUCCIONES]: ACTÚA como un vendedor llamado {vendedor} de una tienda en linea denominado {negocio}, con los siguientes productos {productos} y el cliente {cliente} que te escribe desde whatsapp, IMPORTANTE: el {cliente} ya acaba de iniciar el chat, debes responder con una vienvenida, mostrando los productos disponibles."
        //     var cliente = "cliente="+customer
        //     var negocio = "negocio=IPTV-BOLIVIA"
        //     var productos = "productos=MagisTV con precios de 60/Mes Bs. y MasTv con precio de 50/Mes Bs."
        //     var vendedor = "vendedor=Luis Flores"
        //     var inicio = mipront + "\n" + cliente + "\n" + negocio + "\n" + productos + "\n" + vendedor
        //     var newmessage = await axios.post("http://localhost:8000/api/chatbots/save", {
        //         phone: msg.from,
        //         message: inicio
        //     })
        //     console.log(contact)
        //     const completion = await openai.createCompletion({
        //         model: "text-davinci-003",
        //         prompt: inicio
        //     });
        //     console.log(completion.data.choices[0].text)
        //     await client2.sendMessage(msg.from, completion.data.choices[0].text)
        // } else {
            // var newmessage = await axios.post("http://localhost:8000/api/chatbots/save", {
            //     phone: msg.from,
            //     message: msg.body
            // }) 
            // var newpront = ""
            // for (let index = 0; index < newmessage.data.length; index++) {
            //     newpront += "\n"+newmessage.data[index].message
            // }
            // console.log(newpront)
            // const completion = await openai.createCompletion({
            //     model: "text-davinci-003",
            //     prompt: newpront,
            // });

            await axios.post("http://localhost:8000/api/chatbots/save", {
                type: "input",
                busine_id: 1,
                phone: msg.from,
                message: msg.body
            }) 

            var midata = await axios("http://localhost:8000/api/business/id/1")
            var mimessage = "Hola, soy el asistente virtual del negocio: "+midata.data[0].name
            await axios.post("http://localhost:8000/api/chatbots/save", {
                type: "output",
                busine_id: 1,
                phone: msg.from,
                message: mimessage
            }) 
            await client2.sendMessage(msg.from, mimessage)
        // }
    }
   }
});


client2.on('loading_screen', (percent, message) => {
    console.log('LOADING SCREEN 2', percent, message);
});

// var micount2 = 0
client2.on("qr", async (qrwb) => {
    var qr_svg = qr.image(qrwb, { type: 'png' });
    qr_svg.pipe(require('fs').createWriteStream('qrwb.png'));
    // qrcode.generate(qrwb, {small: true}, function (qrcode) {
    //     console.log(qrcode)
    //     console.log('Nuevo QR, recuerde que se genera cada 1 minuto, INTENTO #'+micount2++)        
    // })
    await axios.post("http://localhost:8000/api/chatbots/save", {
        type: "init",
        busine_id: 1,
        phone: null,
        message: qrcode
    }) 
});

client2.on('authenticated', () => {
    console.log('AUTHENTICATED 2');
});

client2.on('auth_failure', msg => {
    // Fired if session restore was unsuccessful
    console.error('AUTHENTICATION FAILURE 2', msg);
});

client2.on('ready', async () => {
    console.log('READY 2');
    await axios.post("http://localhost:8000/api/chatbots/save", {
        type: "start",
        busine_id: 1,
        phone: null,
        message: null
    }) 
});


client2.on('group_join', (notification) => {
    // User has joined or been added to the group.
    console.log('join 2', notification);
   // myGroupName.addParticipants([notification.id.participant]);
    console.log('-------------------------------------');
    // notification.reply('User joined.');
});

client2.on('group_leave', (notification) => {
    // User has left or been kicked from the group.
    console.log('leave 2', notification);
    console.log('-------------------------------------');
    // notification.reply('otro mas que abandona el grupo.');
});
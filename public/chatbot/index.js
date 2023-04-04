const { Client, Location, List, Buttons, LocalAuth} = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
var path = require('path');
require('dotenv').config()
const axios = require('axios');

const client = new Client({
    authStrategy: new LocalAuth({
        clientId: 'client'+process.env.NEGOCIO
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

client.initialize();
client.on('message', async msg => {
    let chat = await msg.getChat();
    const contact = await msg.getContact();
    if (chat.isGroup) {
        // console.log(msg)
    } else {
        const isBroadcast = msg.broadcast || msg.isStatus;
        if (isBroadcast || (msg.from == "status@broadcast")) {
            // console.log(msg)
        }else{
            await axios.post(process.env.HOST+"api/chatbots/send", {
                type: "msg_input",
                busine: process.env.NEGOCIO,
                phone: msg.from,
                message: msg.body
            }) 

            var midata = await axios(process.env.HOST+"api/business/id/"+process.env.NEGOCIO)
            var mimessage = "Hola, soy el asistente virtual del negocio: "+midata.data[0].name
            await axios.post(process.env.HOST+"api/chatbots/send", {
                type: "msg_output",
                busine: process.env.NEGOCIO,
                phone: msg.from,
                message: mimessage
            }) 
            await client.sendMessage(msg.from, mimessage)
        }
    }
});


client.on('loading_screen', async (percent, message) => {
    console.log('LOADING SCREEN', percent, message);
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "loading_screen",
        busine: process.env.NEGOCIO,
        phone: null,
        message: (percent+" "+message)
    }) 
});

client.on("qr", async (qrwb) => {
    // var qr_svg = qr.image(qrwb, { type: 'png' });
    // qr_svg.pipe(require('fs').createWriteStream('qrwb.png'));
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "qr",
        busine: process.env.NEGOCIO,
        phone: null,
        message: qrwb
    }) 
    console.log(qrwb);
});

client.on('authenticated', async () => {
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "authenticated",
        busine: process.env.NEGOCIO,
        phone: null,
        message: "Sesion iniciada.."
    }) 
    console.log('Sesion iniciada..');
});

client.on('auth_failure',async  msg => {
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "auth_failure",
        busine: process.env.NEGOCIO,
        phone: null,
        message: "Error al iniciar sesion.."
    }) 
    console.error('AUTHENTICATION FAILURE', msg);
});

client.on('ready', async () => {
    console.log('READY');
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "ready",
        busine: process.env.NEGOCIO,
        phone: null,
        message: null
    }) 
});


client.on('group_join', async (notification) => {
    console.log('join', notification);
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "group_join",
        busine: process.env.NEGOCIO,
        phone: null,
        message: notification
    }) 
});

client.on('group_leave', async (notification) => {
    console.log('leave', notification);
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "group_leave",
        busine: process.env.NEGOCIO,
        phone: null,
        message: notification
    }) 
});
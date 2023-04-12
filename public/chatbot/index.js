const { Client, Location, List, Buttons, LocalAuth, MessageMedia } = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
var path = require('path');
require('dotenv').config()
const axios = require('axios');
const sleep = require('sleep-promise');

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
            try {
                var midata = await axios(process.env.HOST+"api/business/id/"+process.env.NEGOCIO)
                switch (msg.body) {
                    case "1":
                        break;
                    case "2":
                        break;
                    case "3":
                        
                        break;
                    case "marketing":
                        try {
                            var micontact = await client.getContacts()
                            const mimedia = MessageMedia.fromFilePath(path.join(__dirname, '/media/')+"estascansado.mp4")
                            const mimessage = "📣 PUBLICIDAD 📣\n!! Televisión por Internet para toda BOLIVIA 🇧🇴 !!\nsin cables sin antenas y sin contratos, fácil y rápido.\nmas info en https://chat.whatsapp.com/E011eqYPNX06so8xB2I68v"
                                micontact.forEach(async function(item, index) { 
                                    var nombre = item.name || item.pushname || item.verifiedName
                                    setTimeout(async () => {   
                                        if ( nombre != undefined) {
                                            // await client.sendMessage(item.number+"@c.us",  mimedia, {caption: mimessage})
                                            await axios.post(process.env.HOST+"api/chatbots/send", {
                                                type: "marketing",
                                                busine: process.env.NEGOCIO,
                                                phone: item.number,
                                                message: index+".- "+item.number
                                            }) 
                                        }           
                                    },index * 30000);
                                });
                                                        
                        } catch (error) {
                            await axios.post(process.env.HOST+"api/chatbots/send", {
                                type: "error",
                                busine: process.env.NEGOCIO,
                                phone: null,
                                message: error
                            }) 
                        }
                        break;
                    case "contactos":
                        await contactos()
                        break;
                    default:
                        var mii = msg.body.toLocaleUpperCase()
                        if(mii == "HOLA" || mii == "BUENAS"){                    
                            await axios.post(process.env.HOST+"api/chatbots/send", {
                                type: "msg_input",
                                busine: process.env.NEGOCIO,
                                phone: msg.from,
                                message: msg.body
                            }) 
                            var mimenu = "1.- Informacion\n2.- Productos\n3.- Chat con vendedor@"
                            var misms = process.env.WELCOME+"\n*!! "+midata.data.locations[0].name+" !!*\n"+mimenu+"\nEnviar una de las opciones disponibles (1..2)"
                            const media = MessageMedia.fromFilePath('../uploads/business_logos/'+midata.data.logo);
                            // await client.sendMessage(msg.from, media, {caption: misms});
                        }
                        break;
                }
            } catch (error) {
                console.log(error)            
            }
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
    await contactos()
});


client.on('group_join', async (notification) => {
    console.log('join', notification);
    // console.log(notification.getChat())
    // console.log(notification.getContact())
    // console.log(notification.getRecipients())
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "group_join",
        busine: process.env.NEGOCIO,
        phone: null,
        message: notification
    }) 
    const mimedia = MessageMedia.fromFilePath(path.join(__dirname, '/media/')+process.env.PMEDIA)
    const mimessage = process.env.PMSG
    //await client.sendMessage(notification.recipientIds[0],  mimedia, {caption: mimessage})
});

client.on('group_leave', async (notification) => {
    //console.log('leave', notification);
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "group_leave",
        busine: process.env.NEGOCIO,
        phone: null,
        message: notification
    }) 
    const mimedia = MessageMedia.fromFilePath(path.join(__dirname, '/media/')+process.env.PMEDIA)
    const mimessage = process.env.PMSG
    //await client.sendMessage(notification.recipientIds[0],  mimedia, {caption: mimessage})
});

client.on('group_update', async (notification) => {
    // Group picture, subject or description has been updated.
    //console.log('update', notification);
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "group_update",
        busine: process.env.NEGOCIO,
        phone: null,
        message: notification
    }) 
    const mimedia = MessageMedia.fromFilePath(path.join(__dirname, '/media/')+process.env.PMEDIA)
    const mimessage = process.env.PMSG
    //await client.sendMessage(notification.chatId,  mimedia, {caption: mimessage})
});

client.on('change_state', async state => {
    //console.log('CHANGE STATE', state);
    await axios.post(process.env.HOST+"api/chatbots/send", {
        type: "change_state",
        busine: process.env.NEGOCIO,
        phone: null,
        message: state
    }) 
});


async function contactos(){
    try {
        var micontact = await client.getContacts()
        var allcon = []
        micontact.forEach(async function(item, index) {
            // console.log(item)
            if(item.isMyContact){
                // var nombre = item.name || item.pushname || item.verifiedName
                // var numero = item.number
                // if ( nombre != undefined) {
                //     var mitipo = null
                //     if (item.isBlocked) {
                //         mitipo = "isBlocked"
                //     }else if(item.isMyContact){
                //         mitipo = "isMyContact"
                //         // console.log(item.isMyContact)
                //     }else if(item.isWAContact){
                //         mitipo = "isWAContact"
                //     }else if(item.isGroup){
                //         mitipo = "isGroup"
                //     }else if(item.isUser){
                //         mitipo = "isUser"
                //     }
                //     var miarray = {
                //         nombre: nombre,
                //         numero: numero,
                //         type: mitipo,
                //         isMe: item.isMe,
                //         isUser: item.isUser,
                //         isGroup: item.isGroup,
                //         isWAContact: item.isWAContact,
                //         isMyContact: item.isMyContact,
                //         isBlocked: item.isBlocked,
                //         id: item.id                           
                //     }
              
                    allcon.push(item)
                 
            }
            // }
        });
        await axios.post(process.env.HOST+"api/chatbots/send", {
            type: "contactos",
            busine: process.env.NEGOCIO,
            phone: null,
            message: allcon
        }) 
    } catch (error) {

    }
    // await client.sendMessage(msg.from, "revisa el panel de pos");
}
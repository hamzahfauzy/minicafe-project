import http from 'http'
import express from 'express'
import bodyParser from 'body-parser'

import { Server } from 'socket.io'

const socketPort = 3000

const app = express()

const webserver = http.createServer(app)

let subscribers = []

webserver.listen(socketPort, () => {
    console.log('server started on port '+socketPort)
})

app.use(express.json())
app.use(bodyParser.urlencoded({ extended: false }))

// CORS
app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "*");
    res.header("Access-Control-Allow-Methods", "*");
    next();
});

app.get('/', (req, res) => {
    res.send('Hello World')
})

app.post('/broadcast', (req, res) => {
    const body = req.body
    const cafe = body.cafe
    const target = body.target ?? null
    const message = body.message
    const subs = subscribers.filter(c => target ? c.userId == target : c.cafeId == cafe)
    subs.forEach(subscriber => {
        const socket = subscriber.socket
        socket.emit('push notification', {message: body.message, url:body.url})
    })
    res.send('broadcast message '+message)
})

const io = new Server(webserver, {
    handlePreflightRequest: (req, res) => {
        const headers = {
            "Access-Control-Allow-Headers": "Content-Type, Authorization",
            "Access-Control-Allow-Origin": "*", //or the specific origin you want to give access to,
            "Access-Control-Allow-Credentials": true
        };
        res.writeHead(200, headers);
        res.end();
    },
    cors: {
        origin: '*', // process.env.ALLOWED_HOST,
        methods: ["GET", "POST"]
    }
})

io.on('connection', socket => {

    console.log(socket.id);

    socket.on('subscribe', (data) => {
        const userId = data.userId
        const cafeId = data.cafeId

        // is already subscribe
        // const subscribe = subscribers.find(c => c.userId == userId && c.cafeId == cafeId)

        subscribers.push({userId, cafeId, socket})
        
        socket.on('disconnect', () => {
            // remove from subscribers
            const tmpClients = subscribers.filter(c => c.socket.id == socket.id)
            for(var i=0;i<tmpClients.length;i++)
            {
                const client = tmpClients[i]
                const index  = subscribers.indexOf(client)
                subscribers.splice(index, 1)
            }
        })
    })

})
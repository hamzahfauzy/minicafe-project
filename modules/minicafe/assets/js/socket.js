console.log('socket.js')


Notification.requestPermission().then(perm => {
    if(perm == 'granted')
    {
        const socket = io("http://localhost:3000");
        socket.on("connect", () => {
            console.log(socket.id); 

            const employee = window.employee
        
            socket.emit('subscribe', {userId:employee.user_id, cafeId:employee.cafe_id, roles:employee.roles})
        
            socket.on('push notification', data => {
                console.log(data)
                let notif = new Notification(data.message)
                notif.onclick = (ev) => {
                    ev.preventDefault()
                    window.open(data.url)
                }
            })
        });
    }
})

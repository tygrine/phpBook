require('./bootstrap');
require('./forum.blade');
require('./show.blade');

window.Vue = require('vue');

Vue.component('notification', require('./components/Notification.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        notifications: '',
    },
    created() {
        axios.post('/notification/get').then(response => {
            $data = this.notifications = response.data;
            $like = $data.filter(data=> data.like === 'true');
        });

        var userid = $('meta[name="userid"]').attr('content');
        Echo.private('App.User.' + userid).notification((notification) => {
            this.notifications.push(notification)
        });
    },
});
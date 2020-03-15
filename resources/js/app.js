require('./bootstrap');
require('./forum.blade');

window.Vue = require('vue');

Vue.component('notification', require('./components/Notification.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        notifications: '',
    },
    created() {
        axios.post('/notification/get').then(response => {
            this.notifications = response.data
        });

        var userid = $('meta[name="userid"]').attr('content');
        Echo.private('App.User.' + userid).notification((notification) => {
            console.log(notification);
        });
    }
});
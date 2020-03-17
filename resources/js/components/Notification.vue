<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications <span class="badge badge-primary">{{ notifications.length }}</span> <span class="caret"></span>
        </a>

            <ul class="dropdown-menu" role="menu">

                <li v-for="(notification, index) in notifications" v-if="notification.data.like == true">
                    <a href="#" v-on:click="MarkAsRead(notification)" class="dropdown-item">
                    {{ notification.data.user.name }} has liked your post. <br>
                    <small>{{ notification.data.post.post_title }}</small>
                    </a>
                </li>

                <li v-for="(notification, index) in notifications" v-if="notification.data.reply == true">
                    <a href="#" v-on:click="MarkAsRead(notification)" class="dropdown-item">
                    <i class="fa fa-comments fa-xs" aria-hidden="true"></i>
                    {{ notification.data.user.name }} has replied to your post. <br>
                    <small>{{ notification.data.post.post_title }}</small>
                    </a>
                </li>

                <li v-if="notifications.length == 0">
                    No new notifications to show.
                </li>

                <li v-else>
                <a href="#" class="d-flex justify-content-center">Clear all</a>
                </li>

            </ul>
    </li>
</template>

<script>
    export default {
      props: ['notifications'],
      methods: {
          MarkAsRead: function(notification){
              var data = {
                  id: notification.id,
              };
              axios.post('/notification/read', data).then(response => {
                  console.log('Notification cleared');
              })
          }
      }
    }
</script>

<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications <span class="badge badge-primary">{{ notifications.length }}</span> <span class="caret"></span>
        </a>

            <ul class="dropdown-menu" role="menu">
                <li v-for="notification in notifications">
                    <a href="#" v-on:click="MarkAsRead(notification)">
                    {{ notification.data.user.name }} has liked your post. <br>
                    <small>{{ notification.data.post.post_title }}</small>
                    </a>
                </li>
                <li v-if="notifications.length == 0">
                    No new notifications to show.
                </li>
            </ul>
    </li>
</template>

<script>
    export default {
      props: ['notifications', 'userid'],
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


/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

var notifications = [];

window.Pusher = require('pusher-js');
import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0d6ee4b3b18bda9d29f6',
    cluster: 'ap1',
    encrypted: true
});

//...

$(document).ready(function () {
    if (Laravel.userId) {
        //...
        window.Echo.private(`App.User.${Laravel.userId}`)
            .notification((notification) => {
                addNotifications([notification], '#notifications');
            });
    }
});

$(document).ready(function () {
    // check if there's a logged in user
    if (Laravel.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li>No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}

const NOTIFICATION_TYPES = {
    komentar: 'App\\Notifications\\UserCommentNotification',
};
//...
function routeNotification(notification) {
    var to = `?read=${notification.id}`;
    const postId = notification.data.comment_id;
    to = `/contributor/comments/detail/${postId}` + to;
    return '/' + to;
}

function makeNotificationText(notification) {
    var text = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += `<strong>${name}</strong> followed you`;
    } else if (notification.type === NOTIFICATION_TYPES.komentar) {
        const name = notification.data.username;
        text += `<strong>${name}</strong> published a post`;
    }
    return text;
}
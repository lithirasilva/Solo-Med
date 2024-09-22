// src/eventBus.js
import { reactive } from 'vue';

const state = reactive({
    notifications: []
});

const addNotification = (notification) => {
    state.notifications.push(notification);
    console.log('Notification added to state:', state.notifications);
};

const clearNotifications = () => {
    state.notifications = [];
};

export default {
    state,
    addNotification,
    clearNotifications
};

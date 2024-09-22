<template>
  <div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Notifications</h2>
    <div v-if="notifications.length === 0" class="text-gray-500">
      No notifications to display.
    </div>
    <div class="space-y-4">
      <div
        v-for="(notification, index) in notifications"
        :key="index"
        class="bg-white p-4 rounded-lg shadow flex items-center justify-between"
      >
        <div>
          <h3 class="text-lg font-bold">{{ notification.title }}</h3>
          <p class="text-sm text-gray-500">Date: {{ notification.date }}</p>
          <p class="text-sm text-gray-500">Time: {{ notification.time }}</p>
        </div>
        <button @click="removeNotification(index)" class="text-red-500 hover:text-red-700">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const notifications = ref([]);

// Fetch notifications from localStorage on component mount
onMounted(() => {
  notifications.value = JSON.parse(localStorage.getItem('notifications')) || [];
});

// Remove a notification
const removeNotification = (index) => {
  notifications.value.splice(index, 1);
  localStorage.setItem('notifications', JSON.stringify(notifications.value));
};
</script>

<style scoped>
/* Your styles can stay the same */
</style>

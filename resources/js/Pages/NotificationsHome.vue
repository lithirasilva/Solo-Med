<script setup>
import { ref, onMounted } from 'vue';
import eventBus from '@/eventBus'; // Event bus for handling notifications
import AppLayout from "@/Layouts/AppLayout.vue";

// Set layout for the page
defineOptions({
    layout: AppLayout
});

// Notifications state
const notifications = ref([]);

// Fetch notifications from eventBus on component mount
onMounted(() => {
  notifications.value = eventBus.state.notifications; // Fetch notifications
});

// Remove a notification
const removeNotification = (index) => {
  eventBus.removeNotification(index); // Remove notification using eventBus
};
</script>

<template>
  <div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Notifications</h2>

    <!-- Check if there are no notifications to display -->
    <div v-if="notifications.length === 0" class="text-gray-500">
      No notifications to display.
    </div>

    <!-- Display notifications -->
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

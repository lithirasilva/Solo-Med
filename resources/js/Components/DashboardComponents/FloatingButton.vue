<template>
    <!-- Bottom Navigation Bar -->
    <div class="fixed bottom-0 inset-x-0 bg-white shadow-lg border-t md:hidden z-50 transition-transform duration-300">
      <div class="flex items-center justify-around py-2">
        <!-- Render the first 4 items -->
        <div v-for="(item, index) in visibleItems" :key="index" class="text-center">
          <Link
            :href="item.link"
            @click.native.prevent="handleMenuItemClick(item.name)"
            class="flex flex-col items-center text-gray-700 hover:text-orange-400 transition duration-200"
          >
            <i :class="`fa ${item.icon} text-lg`"></i>
          </Link>
        </div>
  
        <!-- Toggle Button (for popup menu) -->
        <div class="text-center relative">
          <button
            @click="togglePopup"
            class="flex flex-col items-center text-gray-700 hover:text-orange-400 transition duration-200"
          >
            <i :class="`fa ${popupOpen ? 'fa-times' : 'fa-plus'} text-lg`"></i>
          </button>
  
          <!-- Floating Action Button Popup -->
          <transition name="pop-up">
            <div 
              v-if="popupOpen"
              class="absolute bottom-full right-1/2 transform translate-x-1/2 z-50 flex flex-col items-center space-y-4 mb-4"
            >
              <!-- Container for Popup Items -->
              <div class="flex flex-col items-center space-y-4">
                <ul class="flex flex-col items-center space-y-4">
                  <!-- Display additional items inside rounded buttons -->
                  <li 
                    v-for="item in additionalItems" 
                    :key="item.name"
                    class="flex items-center justify-center"
                    style="width: 50px; height: 50px;"
                  >
                    <Link
                      :href="item.link"
                      @click.native.prevent="handleMenuItemClick(item.name)"
                      class="flex items-center justify-center text-gray-700 hover:text-orange-400 transition duration-200 bg-white rounded-full shadow-md"
                      style="width: 100%; height: 100%;"
                    >
                      <i :class="`fa ${item.icon} text-xs`" style="font-size: 0.75rem;"></i>
                    </Link>
                  </li>
                </ul>
                <!-- Close Button -->
                
              </div>
            </div>
          </transition>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Link } from '@inertiajs/vue3';
  
  // Define props to accept menu items from the parent (sidebar items)
  const props = defineProps({
    menuItems: {
      type: Array,
      default: () => []
    }
  });
  
  const emit = defineEmits(['tab-change']);
  
  // Show only the first 4 items in the bottom nav bar
  const visibleItems = ref(props.menuItems.slice(0, 4));
  // The remaining items will be shown in the popup
  const additionalItems = ref(props.menuItems.slice(4));
  
  // State to toggle the popup
  const popupOpen = ref(false);
  
  // Toggle the popup menu
  const togglePopup = () => {
    popupOpen.value = !popupOpen.value;
  };
  
  // Emit tab change when an item is clicked
  const handleMenuItemClick = (title) => {
    emit('tab-change', { title });
    // Removed auto-closing the popup here
  };
  </script>
  
  <style scoped>
  /* Bottom navigation styles */
  .fixed {
    position: fixed;
    bottom: 0;
    z-index: 50;
  }
  
  /* Animation for bottom navigation bar */
  .transition-transform {
    transition: transform 0.3s ease;
  }
  
  /* Animation for popup */
  .pop-up-enter-active, .pop-up-leave-active {
    transition: opacity 0.3s ease;
  }
  
  .pop-up-enter, .pop-up-leave-to /* .pop-up-leave-active in <2.1.8 */ {
    opacity: 0;
  }
  
  /* Styling for popup items */
  .bg-white {
    background-color: #ffffff;
  }
  
  .rounded-full {
    border-radius: 9999px; /* Fully rounded */
  }
  
  .shadow-md {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  }
  
  /* Icon styles */
  .text-lg {
    font-size: 1.125rem; /* Size of icons in bottom nav bar */
  }
  
  .text-xs {
    font-size: 0.75rem; /* Size of icons in popup */
  }
  
  /* Popup container positioning */
  .absolute {
    position: absolute;
  }
  
  .bottom-full {
    bottom: 100%; /* Positions above the button */
  }
  
  .transform {
    transform: translateX(50%); /* Center align the popup */
  }
  
  .mb-4 {
    margin-bottom: 16px; /* Space between popup and button */
  }
  </style>
  
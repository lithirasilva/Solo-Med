<script setup>
import { ref, onMounted, nextTick } from 'vue';
import WhySoloMedImage from '../../../../public/images/Feature.png'; // Update with your image path

// Reactive data for the component
const title = ref('Features');
const paragraph1 = ref('SoloMed offers a range of features including appointment scheduling, electronic health records (EHR), billing and invoicing, patient portal, and reporting tools. Each feature is designed to work seamlessly with the others, providing a cohesive experience that helps manage all aspects of a medical practice from a single platform.');
const paragraph2 = ref('Our platform also includes advanced analytics to help track performance and improve operational efficiency. The integration of these features ensures that you have a powerful toolkit to manage your practice effectively, enhancing both the patient and staff experience.');
const bulletPoints = ref([
    'Appointment Scheduling',
    'Electronic Health Records (EHR)',
    'Billing and Invoicing',
    'Patient Portal',
    'Reporting Tools',
    'Advanced Analytics'
]);

// Reference to DOM elements
const textRef = ref(null);
const imageRef = ref(null);

// Intersection Observer setup
const observeElements = () => {
  const options = {
    threshold: 0.1
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('fade-in');
        observer.unobserve(entry.target);
      }
    });
  }, options);

  nextTick(() => {
    if (textRef.value) observer.observe(textRef.value);
    if (imageRef.value) observer.observe(imageRef.value);
  });
};

onMounted(() => {
  observeElements();
});
</script>


<template>
  <div class="min-h-screen bg-orange-0 bg-opacity-0 p-4 sm:p-8 flex flex-col sm:flex-row justify-center items-center space-y-6 sm:space-y-0 sm:space-x-10">
      <!-- Image -->
      <div ref="imageRef" class="flex-none fade-out">
          <img :src="WhySoloMedImage" alt="Image representing SoloMed" class="w-full max-w-[300px] sm:max-w-[800px] max-h-[30vh] sm:max-h-[50vh] object-cover">
      </div>

      <!-- Text Container -->
      <div ref="textRef" class="p-4 sm:p-10 bg-orange-600 text-white rounded-3xl shadow-lg space-y-4 sm:space-y-6 w-full max-w-3xl text-container fade-out">
          <h1 class="text-2xl sm:text-4xl font-bold mb-4 text-center">{{ title }}</h1>

          <div class="space-y-3 sm:space-y-4 font-semibold">
              <p class="text-base sm:text-lg text-justify">{{ paragraph1 }}</p>
              <p class="text-base sm:text-lg text-justify">{{ paragraph2 }}</p>
          </div>

          <ul class="list-disc list-inside text-left mx-auto space-y-2 font-bold">
              <li v-for="(point, index) in bulletPoints" :key="index" class="ml-4 sm:ml-6">{{ point }}</li>
          </ul>
      </div>
  </div>
</template>


<style scoped>
/* Animation */
.fade-out {
    opacity: 0;
    transition: opacity 1s ease-out;
}
.fade-in {
    opacity: 1;
}

/* Container Size Adjustments */
.text-container {
    max-width: 48rem; /* Consistent width for text container */
    max-height: 38rem;
    padding: 2rem; /* Consistent padding inside the container */
}

/* Responsive adjustments */
@media (max-width: 640px) {
    p {
        font-size: 0.875rem; /* Smaller text on small screens */
    }
    ul {
        margin-left: 1.5rem; /* Less indentation on small screens */
    }
    .text-container {
        max-width: 100%; /* Full width on small screens */
        margin-left: 1rem; /* Adjust left margin for small screens */
        padding: 1rem; /* Adjust padding for small screens */
    }
}
</style>

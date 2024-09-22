<script setup>
import { ref, onMounted, nextTick } from 'vue';
import RequestATrialImage from '../../../../public/images/Costing.png';

// Reactive data for the component
const title = ref('Request a Trial');
const paragraph1 = ref('Interested in trying out SoloMed? We offer a free trial period so you can experience our platform firsthand and see how it fits with your practice\'s needs. To request a trial, simply fill out our contact form or reach out to our sales team.');
const paragraph2 = ref('We’ll get you set up with a demo and provide all the support you need to get started. Take advantage of this opportunity to explore all the features and benefits of SoloMed and see how it can revolutionize your clinic\'s management.');
const bulletPoints = ref([
    'Free Trial Period',
    'Hands-On Demo',
    'Personalized Support',
    'Explore Features and Benefits'
]);

// References to DOM elements
const imageContainerRef = ref(null);
const textContainerRef = ref(null);

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
    if (imageContainerRef.value) observer.observe(imageContainerRef.value);
    if (textContainerRef.value) observer.observe(textContainerRef.value);
  });
};

onMounted(() => {
  observeElements();
});
</script>

<template>
    <div class="min-h-screen bg-orange-0 bg-opacity-0 p-4 sm:p-12 flex justify-center items-center">
        <div class="flex flex-col sm:flex-row items-center max-w-7xl mx-auto">
            <!-- Image -->
            <div ref="imageContainerRef" class="flex-none sm:mr-10 mb-6 sm:mb-0 fade-out">
                <img :src="RequestATrialImage" alt="Image representing Request a Trial" class="w-full max-w-[300px] sm:max-w-[800px] max-h-[40vh] sm:max-h-[50vh] object-cover">
            </div>
            <!-- Text Content -->
            <div ref="textContainerRef" class="p-6 sm:p-10 bg-orange-600 text-white rounded-3xl shadow-lg space-y-4 sm:space-y-6 max-w-2xl sm:max-w-7xl text-container fade-out">
                <h1 class="text-2xl sm:text-4xl font-bold">{{ title }}</h1>
                <div class="mt-4 space-y-4 font-bold">
                    <p>{{ paragraph1 }}</p>
                    <p>{{ paragraph2 }}</p>
                </div>
                <ul class="list-disc list-inside mt-6 space-y-2 font-bold">
                    <li v-for="(point, index) in bulletPoints" :key="index">{{ point }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Animation */
.fade-out {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 1s ease-out, transform 1s ease-out;
}
.fade-in {
    opacity: 1;
    transform: translateY(0);
}

/* Text Content Adjustments */
.text-container h1 {
    margin-bottom: 1.5rem; /* Adds space below the title */
}

.text-container p {
    margin-bottom: 1.25rem; /* Adds space between paragraphs */
}

.text-container ul li {
    margin-bottom: 1rem; /* Adds space between list items */
}

/* Responsive adjustments */
@media (max-width: 640px) {
    p {
        font-size: 0.875rem; /* Smaller text on small screens */
    }
    ul {
        margin-left: 1.5rem; /* Less indentation on small screens */
    }
}
</style>

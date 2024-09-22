<script setup>
import { ref, onMounted, nextTick } from 'vue';
import WhySoloMedImage from '../../../../public/images/thinking.png'; // Update with your image path

// Reactive data for the component
const title = ref('Why SoloMed?');
const paragraph1 = ref('SoloMed stands out due to its comprehensive feature set and user-friendly interface. Unlike other medical practice management systems, SoloMed is designed with flexibility in mind, allowing customization to fit the unique needs of different medical practices. Its integration capabilities with existing systems and its robust support ensure that medical professionals can focus more on patient care rather than administrative tasks.');
const paragraph2 = ref('With SoloMed, you get a highly customizable solution tailored to meet the specific needs of your practice. Its seamless integration with various healthcare systems, coupled with a user-centric design, means that managing your clinic becomes a streamlined process. Our dedicated support team is always ready to assist you in optimizing your use of the platform and ensuring it fits perfectly within your existing workflows.');
const bulletPoints = ref([
    'Comprehensive Feature Set',
    'Flexible and Customizable',
    'Seamless Integration',
    'User-Friendly Interface',
    'Robust Support and Training'
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
    <div class="min-h-screen bg-orange-0 bg-opacity-0 p-4 sm:p-12">
        <div class="flex flex-col sm:flex-row items-start sm:items-center max-w-7xl mx-auto">
            <!-- Text Content -->
            <div ref="textRef" class="p-6 sm:p-10 bg-orange-600 text-white rounded-3xl shadow-lg space-y-4 sm:space-y-6 max-w-2xl sm:max-w-7xl text-container fade-out">
                <h1 class="text-3xl sm:text-4xl font-bold">{{ title }}</h1>
                
                <div class="font-bold">
                    <p>{{ paragraph1 }}</p>
                    <p>{{ paragraph2 }}</p>
                </div>
                <ul class="list-disc list-inside text-left font-bold">
                    <li v-for="(point, index) in bulletPoints" :key="index">{{ point }}</li>
                </ul>
            </div>
            <!-- Image -->
            <div ref="imageRef" class="flex-none sm:ml-10 mt-6 sm:mt-0 sm:relative sm:left-11 fade-out">
                <img :src="WhySoloMedImage" alt="Image representing SoloMed" class="w-full max-w-[300px] sm:max-w-[1500px] max-h-[40vh] sm:max-h-[50vh] object-cover">
            </div>
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

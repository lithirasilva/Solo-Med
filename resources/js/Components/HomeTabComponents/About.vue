<script setup>
import { ref, onMounted, nextTick } from 'vue';
import AboutUsImage from '../../../../public/images/About.png'; // Update with your image path

// Reactive data for the component
const title = ref('About Us');
const paragraph1 = ref('SoloMed was founded with the goal of improving medical practice management through technology. Our team is composed of computing undergrads with an understanding of the challenges faced by medical professionals. We are dedicated to developing solutions that make a real difference in the efficiency and effectiveness of medical practices.');
const paragraph2 = ref('Our mission is to create innovative, user-friendly tools that streamline clinic operations and enhance patient care. We believe in continuous improvement and strive to stay at the forefront of technology to provide our clients with the best possible solutions.');
const bulletPoints = ref([
]);

// References to DOM elements
const textContainerRef = ref(null);
const imageContainerRef = ref(null);

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
    if (textContainerRef.value) observer.observe(textContainerRef.value);
    if (imageContainerRef.value) observer.observe(imageContainerRef.value);
  });
};

onMounted(() => {
  observeElements();
});
</script>

<template>
    <div class="min-h-screen bg-orange-0 bg-opacity-0 p-4 sm:p-8 flex flex-col items-center">
        <!-- Image -->
        <div ref="imageContainerRef" class="mb-6 fade-out">
            <img :src="AboutUsImage" alt="Image representing About Us" class="w-full max-w-[300px] sm:max-w-[600px] max-h-[40vh] sm:max-h-[50vh] object-cover">
        </div>

        <!-- Text Content -->
        <div ref="textContainerRef" class="p-6 sm:p-10 bg-orange-0 text-black rounded-3xl  space-y-4 sm:space-y-6 max-w-2xl sm:max-w-7xl text-center ">
            <h1 class="text-3xl sm:text-4xl font-bold mb-4">{{ title }}</h1>
            <div class="space-y-4 ">
                <p class="text-base sm:text-lg text-center">{{ paragraph1 }}</p>
                <p class="text-base sm:text-lg text-center">{{ paragraph2 }}</p>
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

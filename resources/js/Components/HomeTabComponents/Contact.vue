<script setup>
import { ref, onMounted, nextTick } from 'vue';
import ContactUsImage from '../../../../public/images/contact.png'; // Update with your image path

// Reactive data for the component
const title = ref('Contact Us');
const paragraph1 = ref('We are here to help you with any questions or concerns you may have about SoloMed. Feel free to reach out to us via our contact form, email, or phone. Our support team is available to assist you with anything from product inquiries to technical support.');
const paragraph2 = ref('We value your feedback and look forward to hearing from you. Our goal is to provide prompt and helpful responses to ensure that you have the best possible experience with our platform. Contact us today to get in touch with our dedicated support team.');
const bulletPoints = ref([
    // 'Contact Form',
    // 'Email Support',
    // 'Phone Support',
    // 'Prompt Responses',
    // 'Valuable Feedback'
]);

// References to DOM elements
const contentRef = ref(null);
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
    if (contentRef.value) observer.observe(contentRef.value);
    if (imageRef.value) observer.observe(imageRef.value);
  });
};

onMounted(() => {
  observeElements();
});
</script>

<template>
    <div class="min-h-screen bg-orange-0 bg-opacity-0 p-8 flex flex-col items-center">
        <div ref="contentRef" class="text-center p-8 bg-orange-00 text-black rounded-lg space-y-6 max-w-7xl w-full fade-out">
            <h1 class="text-4xl font-bold mb-4">{{ title }}</h1>

            <div class="space-y-4 text-center">
                <p class="text-lg">{{ paragraph1 }}</p>
                <p class="text-lg">{{ paragraph2 }}</p>
            </div>

            <ul v-if="bulletPoints.length > 0" class="list-disc list-inside text-left mx-auto space-y-2 fade-out">
                <li v-for="(point, index) in bulletPoints" :key="index" class="ml-6">{{ point }}</li>
            </ul>
        </div>

        <!-- Image Section -->
        <div ref="imageRef" class="mt-8 fade-out">
            <img :src="ContactUsImage" alt="Contact Us Image" class="w-full max-w-[500px] sm:max-w-[600px] object-cover rounded-lg">
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

/* General styling */
p {
    padding: 0.5rem;
    margin: 0.5rem 0;
}

ul {
    padding: 0;
    margin-left: 2rem;
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

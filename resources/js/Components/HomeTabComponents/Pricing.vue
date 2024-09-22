<script setup>
import { ref, onMounted, nextTick } from 'vue';
import PricingImage from '../../../../public/images/AboutUs.png';

// Reactive data for the component
const title = ref('Pricing');
const paragraph1 = ref('SoloMed provides flexible pricing options to accommodate practices of all sizes. We offer tiered pricing plans based on the number of users and the features required. There is also an option for custom pricing for large practices or those with specialized needs.');
const paragraph2 = ref('Our transparent pricing model ensures that you only pay for what you need. Contact us for a personalized quote and to learn more about our pricing structure. We are here to help you find the best solution that fits your practice’s requirements and budget.');

// References to DOM elements
const textContainerRef = ref(null);
const imageContainerRef = ref(null);
const pricingCardsRef = ref(null);

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
    if (pricingCardsRef.value) observer.observe(pricingCardsRef.value);
  });
};

onMounted(() => {
  observeElements();
});
</script>

<template>
    <div class="min-h-screen bg-orange-0 bg-opacity-0 p-4 sm:p-12">
        <!-- Text Content -->
        <div ref="textContainerRef" class="flex flex-col items-center max-w-7xl mx-auto mb-12 fade-out">
            <!-- Image and Paragraph Content -->
            <div class="flex flex-col items-center max-w-7xl mx-auto space-y-6">
                <!-- Image -->
                <div ref="imageContainerRef" class="mb-6 fade-out">
                    <img :src="PricingImage" alt="Image representing Pricing" class="w-full max-w-[500px] max-h-[50vh] object-cover">
                </div>
                <!-- Paragraph Content -->
                <div class="p-6 sm:p-10 bg-orange-600 text-white rounded-3xl shadow-lg space-y-4 sm:space-y-6 text-container font-bold text-center ">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-4">{{ title }}</h1>
                    <div>
                        <p>{{ paragraph1 }}</p>
                        <p>{{ paragraph2 }}</p>
                    </div>
                </div>
                <!-- Pricing Cards -->
                 
                <div ref="pricingCardsRef" class="flex flex-wrap justify-between w-full max-w-7xl  ">
                    <div class="pricing-card1 p-6 shadow-lg rounded-xl transition-transform transform hover:scale-105 flex-1 mx-2 mb-6 bg-[color] text-[color]">
                        <h2 class="text-xl font-bold mb-2">Free Trial</h2>
                        <p>Experience SoloMed with a free 14-day trial. No commitment required, and you’ll have access to all essential features to evaluate if SoloMed is the right fit for your practice.</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li>14-day free trial</li>
                            <li>Access to all features</li>
                            <li>Up to 5 users</li>
                            <li>Email notifications</li>
                        </ul>
                        <p class="mt-4 font-bold">Free for 14 days</p>
                    </div>
                    
                    <!-- Basic Plan -->
                    <div class="pricing-card2 p-6 shadow-lg rounded-xl transition-transform transform hover:scale-105 flex-1 mx-2 mb-6 bg-[color] text-[color]">
                        <h2 class="text-xl font-bold mb-2">Basic Plan</h2>
                        <p>Ideal for small practices just getting started. Includes essential features for managing appointments, patient records, and basic reporting.</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li>Up to 5 users</li>
                            <li>Basic appointment scheduling</li>
                            <li>Patient record management</li>
                            <li>Email notifications</li>
                        </ul>
                        <p class="mt-4 font-bold">Rs.5000/month</p>
                    </div>
                    <!-- Standard Plan -->
                    <div class="pricing-card3 p-6 shadow-lg rounded-xl transition-transform transform hover:scale-105 flex-1 mx-2 mb-6 bg-[color] text-[color]">
                        <h2 class="text-xl font-bold mb-2">Standard Plan</h2>
                        <p>Designed for growing practices with additional needs. Offers advanced features for enhanced practice management and reporting.</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li>Up to 20 users</li>
                            <li>Advanced appointment scheduling</li>
                            <li>Comprehensive patient record management</li>
                            <li>Customizable notifications</li>
                            <li>Basic reporting and analytics</li>
                        </ul>
                        <p class="mt-4 font-bold">Rs.10,000/month</p>
                    </div>
                    <!-- Premium Plan -->
                    <div class="pricing-card4 p-6 shadow-lg rounded-xl transition-transform transform hover:scale-105 flex-1 mx-2 mb-6 bg-[color] text-[color]">
                        <h2 class="text-xl font-bold mb-2">Premium Plan</h2>
                        <p>For large or specialized practices requiring full-featured management tools. Includes all features plus premium support and customization options.</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li>Unlimited users</li>
                            <li>Full-featured appointment scheduling</li>
                            <li>Advanced patient record management</li>
                            <li>Customizable workflows and notifications</li>
                            <li>Advanced reporting and analytics</li>
                            <li>Priority support and customization options</li>
                        </ul>
                        <p class="mt-4 font-bold">Rs.15,000/month</p>
                    </div>
                </div>
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

/* Container Size Adjustments */
.text-container {
    max-width: 48rem; /* Consistent width for text container */
    max-height: 38rem;
    padding: 2rem; /* Consistent padding inside the container */
}

/* Pricing Card */
.pricing-card {

    transition: background-color 0.3s, color 0.3s, transform 0.3s;
}

/* Hover Effect */
.pricing-card1:hover {
    background-color: #FF0030; /* Primary orange color */
    color: white;
}
.pricing-card2:hover {
    background-color: #FF0030; /* Primary orange color */
    color: white;
}
.pricing-card3:hover {
    background-color: #FF0030; /* Primary orange color */
    color: white;
}
.pricing-card4:hover {
    background-color: #FF0030; /* Primary orange color */
    color: white;
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

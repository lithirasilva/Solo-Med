<template>
    <form @submit.prevent="verifyOtp">
        <input v-model="otp" type="text" placeholder="Enter OTP" required>
        <button type="submit">Verify OTP</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            otp: ''
        };
    },
    methods: {
        verifyOtp() {
            this.$inertia.post('/public-appointments/verify-otp', { otp: this.otp });
        }
    }
};
</script>

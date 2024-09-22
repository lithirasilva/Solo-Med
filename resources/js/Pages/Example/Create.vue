<template>
    <div>
        <h1>Create Example</h1>
        <form @submit.prevent="createExample">
            <input v-model="form.name" type="text" placeholder="Name" />
            <textarea v-model="form.description" placeholder="Description"></textarea>
            <button type="submit">Create</button>
        </form>
        <router-link to="/examples">Cancel</router-link>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { useRouter } from 'vue-router'

const router = useRouter()
const form = useForm({
    name: '',
    description: '',
})

const createExample = () => {
    form.post('/examples').then(() => router.push('/examples'))
}
</script>

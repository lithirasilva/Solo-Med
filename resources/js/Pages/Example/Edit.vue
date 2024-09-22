<template>
    <div>
        <h1>Edit Example</h1>
        <form @submit.prevent="updateExample">
            <input v-model="form.name" type="text" placeholder="Name" />
            <textarea v-model="form.description" placeholder="Description"></textarea>
            <button type="submit">Save</button>
        </form>
        <router-link :to="`/examples/${form.id}`">Cancel</router-link>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const { example } = usePage().props

const form = useForm({
    id: example.id,
    name: example.name,
    description: example.description,
})

const updateExample = () => {
    form.put(`/examples/${form.id}`).then(() => router.push('/examples'))
}
</script>

<template>
    <div>
        <h1>Examples</h1>
        <a href="{{ route('examples.create') }}">Create New Example</a>
        <ul>
            <li v-for="example in examples" :key="example.id">
                <router-link :to="`/examples/${example.id}`">{{ example.name }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const { examples } = usePage().props
</script>

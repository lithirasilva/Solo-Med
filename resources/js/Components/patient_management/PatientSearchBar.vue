<template>
    <div class="relative flex flex-col space-y-2">
        <input
            type="text"
            v-model="query"
            @input="handleInput"
            placeholder="Search..."
            class="p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <ul
            v-if="showDropdown"
            class="absolute w-full mt-1 border border-gray-300 bg-white rounded-lg shadow-lg max-h-60 overflow-auto z-10"
        >
            <li
                v-for="item in filteredItems"
                :key="item[key]"
                @click="selectItem(item)"
                class="p-2 cursor-pointer hover:bg-gray-100"
            >
                {{ displayText(item) }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import {ref, computed, defineProps, defineEmits} from 'vue';

const props = defineProps({
    data: {
        type: Array,
        required: true,
    },
    key: {
        type: String,
        required: true,
    },
    searchableBy: {
        type: Array,
        required: true,
    },
    displayInSearch: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);

const query = ref('');
const selectedItem = ref(null);
const showDropdown = ref(false);

const key = props.key;
const searchableBy = props.searchableBy;
const displayInSearch = props.displayInSearch;

const filteredItems = computed(() => {
    const lowerQuery = query.value.toLowerCase();
    return props.data.filter(item =>
        searchableBy.some(field =>
            item[field] && item[field].toString().toLowerCase().includes(lowerQuery)
        )
    );
});

const displayText = item => {
    return displayInSearch.map(field => item[field]).join(' ');
};

const handleInput = () => {
    showDropdown.value = true;
};

const selectItem = (item) => {
    selectedItem.value = item[key];
    query.value = displayText(item);
    showDropdown.value = false;
    emit('update:modelValue', selectedItem.value); // Ensure this line is executed correctly
};


document.addEventListener('click', (event) => {
    const input = document.querySelector('input');
    const dropdown = document.querySelector('ul');
    if (input && !input.contains(event.target) && dropdown && !dropdown.contains(event.target)) {
        showDropdown.value = false;
    }
});
</script>

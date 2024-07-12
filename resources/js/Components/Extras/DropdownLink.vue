<script setup>

defineProps({
    href: {
        type: String,
        required: true,
    },
    as: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div>
        <button type="submit" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 dark:text-white dark:hover:bg-gray-500 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" v-if="as == 'button'">
            <slot></slot>
        </button>

        <router-link :to="href" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none dark:text-white dark:hover:bg-gray-500 focus:bg-gray-100 transition duration-150 ease-in-out" v-else>
            <slot></slot>
        </router-link>
    </div>
</template>

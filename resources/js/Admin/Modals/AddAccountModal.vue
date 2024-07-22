<template>
  <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/3">
      <slot></slot>
      <button @click="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AddAccountModal',
  props: {
    isVisible: {
      type: Boolean,
      required: true
    }
  },
  methods: {
    closeModal() {
      this.$emit('close');
    }
  }
};
</script>

<style scoped>
/* Add any additional styling for the modal here if needed */
</style>
<template>
  <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/4">
      <slot></slot>
      <div class="flex justify-between items-center mt-1 ">
          <button @click="saveFaq" class="bg-green-700 text-white px-2 py-1 rounded">Save</button>
          <button @click="closeModal" class="bg-red-500 text-white px-4 py-1 rounded mr-3">Close</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AddFaqModal',
  props: {
    isVisible: {
      type: Boolean,
      required: true
    }
  },
  methods: {
    closeModal() {
      this.$emit('close');
    },
    saveFaq() {
      this.$emit('save'); // Emitting a save event to the parent component
    }
  }
};
</script>

<style scoped>
/* Add any additional styling for the modal here if needed */
</style>
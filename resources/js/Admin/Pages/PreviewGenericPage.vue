<template>
        <div v-if="content" class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4 text-center">Preview Page</h1>
            <p v-html="content"></p>
        </div>
        <button
            @click="genericpages.cancel"
            type="button"
            class="bg-green-500 text-white px-4 py-2 rounded mt-4 ml-2"
            >
            OK
        </button>
</template>


<script setup>
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';
const genericpages = genericpagesStore();
const { content } = storeToRefs(genericpages);
</script>

<style>
.container {
  width: 100%;
  padding: 50px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  background-color: #fff;
}

h1 {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
  padding-left: 7px;
  text-align: center;
}

h2 {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
  padding-left: 7px;
  text-align: left;
}

</style>

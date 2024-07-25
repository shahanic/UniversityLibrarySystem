<script setup>
import { ref } from 'vue';
import { faqsStore } from '@/Admin/Stores/faqsStores';
import { storeToRefs } from 'pinia';
import AddFaqModal from '@/Admin/Modals/AddFaqModal.vue';


const faq = faqsStore();
const { form } = storeToRefs(faq);

faq.getter();

const showModal = ref(false);
const currentFaq = ref(null);  // To store the user being edited

const saveFaq = () => {
  if (currentFaq.value) {
    faq.editFaq(form.value);
    faq.save();
  } else {
    faq.save();
  }
  showModal.value = false;  // Close the modal after saving
};

const addFaq = () => {
  currentFaq.value = null;  // Clear current user for adding a new user
  showModal.value = true;
};

const editFaq = (faqx) => {
  currentFaq.value = faqx;  // Set the user to be edited
  Object.assign(form.value, faqx);  // Populate form with user data
  showModal.value = true;
};

const deleteFaq = (faqx) => {
    faq.deleteFaq(faqx);
};
</script>

<template>
  <admin-layout>
    <template v-slot:main>
      <div>
        <h1>Accounts</h1>
        <p></p>
        <button @click="addFaq" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Add New Faq</button>
        
        <AddFaqModal :isVisible="showModal" @close="showModal = false "@save="saveFaq">
          <div>
        <!--  -->
        <div>
          <h1 style="text-align: center;">Add Faq</h1>
        </div>
        <!--  -->

        <div>
            <label for="name">Question:</label><br>
            <input type="text" v-model="form.question" class="w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label for="email">Answer:</label><br>
          <input type="text" v-model="form.answer" class="w-full rounded-lg border-gray-300">
        </div>

        <div>
          <label for="role">Category:</label><br>
          <select v-model="form.category" class="w-full rounded-lg border-gray-300">
              <option value="1">1</option>
              <option value="2">2</option>
          </select>
        </div>
        <div>
          <label for="role">Satus:</label><br>
          <select v-model="form.status" class="w-full rounded-lg border-gray-300">
              <option value="1">1</option>
              <option value="2">2</option>
          </select>
        </div>
     
        <!-- <div class="flex justify-start  ">
          <button @click="saveUser" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Save</button>
        </div> -->
      </div>
        </AddFaqModal>

        <table class="min-w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-500">
              <th class="border border-white-300 text-white p-2">#</th>
              <th class="border border-white-300 text-white p-2">Question</th>
              <th class="border border-white-300 text-white p-2">Answer</th>
              <th class="border border-white-300 text-white p-2">Category</th>
     
              <th class="border border-white-300 text-white p-2">Status</th>
              <th class="border border-white-300 text-white p-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(faqx, index) in faq.faqs" :key="index" class="bg-white-200">
              <td class="border border-white-300 text-black p-2">{{ index + 1 }}</td>
              <td class="border border-white-300 text-black p-2">{{ faqx.question }}</td>
              <td class="border border-white-300 text-black p-2">{{ faqx.answer }}</td>
              <td class="border border-white-300 text-black p-2">{{ faqx.category }}</td>
              <td class="border border-white-300 text-black p-2">{{ faqx.status }}</td>

              <td class="border border-white-300 text-black p-2 text-center">
                <button @click="editFaq(faqx)" class="bg-yellow-400 text-black px-2 py-1 rounded mr-3">Edit</button>
                <button @click="deleteFaq(faqx)" class="bg-red-400 text-black px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </admin-layout>
</template>
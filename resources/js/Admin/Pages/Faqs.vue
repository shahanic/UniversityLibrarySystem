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
        <br>
        <h2>FAQS</h2>
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
        <br>
        <br>
        <table class="min-w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-white">
                <th class="border border-gray-300 p-2 font-bold">#</th>
                <th class="border border-gray-300 p-2 font-bold">Question</th>
                <th class="border border-gray-300 p-2 font-bold">Answer</th>
                <th class="border border-gray-300 p-2 font-bold">Category</th>
                <th class="border border-gray-300 p-2 font-bold">Status</th>
                <th class="border border-gray-300 p-2 font-bold">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(faqx, index) in faq.faqs" :key="index" class="bg-white">
                <td class="border border-gray-300 text-gray-700 p-2">{{ index + 1 }}</td>
                <td class="border border-gray-300 text-gray-700 p-2">{{ faqx.question }}</td>
                <td class="border border-gray-300 text-gray-700 p-2">{{ faqx.answer }}</td>
                <td class="border border-gray-300 text-gray-700 p-2">{{ faqx.category }}</td>
                <td class="border border-gray-300 text-gray-700 p-2">{{ faqx.status }}</td>
                <td class="border border-gray-300 text-center p-2">
                    <button @click="editFaq(faqx)" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition duration-300 mr-3">
                        <i class="bi bi-pencil-square text-black "></i> 
                    </button>
                    <button @click="deleteFaq(faqx)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition duration-300">
                        <i class="fw-bold text-white bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <br>

      </div>
    </template>
  </admin-layout>
</template>

<style scoped>
.container {
width: 100%;
padding: 100px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
border-radius: 8px;
background-color: #fff;
}

.header {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 10px;
}

h2 {
margin: 0;
font-size: 1.2em;
font-weight: bold;
padding-left: 7px;
text-align: center;
}

.view-details {
text-decoration: none;
color: #007BFF;
font-size: 0.9em;
}

table {
width: 100%;
border-collapse: collapse;
}

th, td {
padding: 8px;
text-align: left;
border-bottom: 1px solid #eee;
}

th {
font-weight: normal;
color: #666;
}

.avatar {
border-radius: 50%;
width: 32px;
height: 32px;
margin-right: 8px;
vertical-align: middle;
}

.leave {
color: #FF4500;
}

.negative {
color: #FF4500;
}

.positive {
color: #4CAF50;
}
</style>
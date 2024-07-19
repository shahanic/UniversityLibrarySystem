<template>
    <admin-layout>
      <div v-if="isVisible" class="modal-overlay" @click="closeModal">
        <div class="modal-content" @click.stop>
          <button class="close-button" @click="closeModal">X</button>
          <div>
            <h1>Manage Account</h1>
            <div>
              <label for="">Name: </label>
              <input type="text" v-model="form.name" />
            </div>
            <div>
              <label for="">Email: </label>
              <input type="text" v-model="form.email" />
            </div>
            <div>
              <label for="">Username: </label>
              <input type="text" v-model="form.username" />
            </div>
            <div>
              <label for="">Role: </label>
              <input type="text" v-model="form.role" />
            </div>
            <div>
              <label for="">Password: </label>
              <input type="text" v-model="form.password" />
            </div>
            <div>
              <button @click="user.save()">Save</button>
            </div>
          </div>
        </div>
      </div>
    </admin-layout>
</template>
  
<script>
  export default {
    props: {
      isVisible: {
        type: Boolean,
        required: true
      },
      form: {
        type: Object,
        required: true
      }
    },
    methods: {
      closeModal() {
        this.$emit('close');
      },
      saveUser() {
        this.$emit('save');
      }
    }
  };
  </script>
  
  <style scoped>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 5px;
    position: relative;
  }
  
  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
  }
  </style>
  
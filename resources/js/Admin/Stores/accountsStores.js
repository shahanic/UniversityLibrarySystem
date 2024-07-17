import { defineStore } from "pinia";

export const accountsStore = defineStore('user', {
    state: () =>{
        return{
            form:{
                name: '',
                username: '',
                email: '',
                role:'',
                password:'',
            }
            
        }
    },

    actions: {
        save(){
            let {form} = this;
            axios.post('/save-user', form).then(({data})=>{
                this.$reset();
                this.getter();
            });

        },
        getter(){
            axios.post('/get-users').then(({data})=>{
                this.users = data;
            })
        },
        editUser(userx){
            this.form = {...userx};
        },
        deleteUser(userx){
            if(confirm('are you sure you want to delete this user?')){
                axios.post('/delete-users', userx).then(({data})=>{
                    this.getter();
                })
            }
        }
    }
})
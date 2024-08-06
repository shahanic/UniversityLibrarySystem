import { defineStore } from "pinia";


export const faqsStore = defineStore('faq', {
    state: () =>{
        return{
            form:{
                question: '',
                answer: '',
                slug: '',
                
                category:'',
                status:'',
            }
            
        }
    },

    actions: {
        generateSlug(question) { 
            return question.toLowerCase().replace(/\s+/g, '-'); 
        },
        save(){
            this.form.slug = this.generateSlug(this.form.question);
            let {form} = this;
            axios.post('/save-faq', form).then(({data})=>{
                this.$reset();
                this.getter();
            });

        },
        getter(){
            axios.post('/get-faqs').then(({data})=>{
                this.faqs = data;
            })
        },
        editFaq(faqx){
            this.form = {...faqx};
        },
        deleteFaq(faqx){
            if(confirm('are you sure you want to delete this faq?')){
                axios.post('/delete-faqs', faqx).then(({data})=>{
                    this.getter();
                })
            }
        }
    }
})
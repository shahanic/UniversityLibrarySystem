import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineStore } from "pinia";

export const articlesStore = defineStore('articlesStore', {
    state: () =>{
        return{
            form:{
                title: '',
                abstract: '',
                content: '',
            },
            articles: [],

            editor: ClassicEditor,
      editorData: "<p>Hello from CKEditor 5!</p>",
      editorConfig: {
        tabSpaces: 4,
        toolbar: {
                  items: [
                      'undo', 'redo',
                      '|', 'heading',
                      '|', 'bold', 'italic', 'numbered',
                      '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
                  ]
                    }
                }
        }
    },

 

    actions: {
        save(){
            let {form} = this;
            axios.post('/save-article', form).then(({data})=>{
                this.$reset();
                this.getter();
            });
        },
        getter(){
            axios.post('/get-articles').then(({data})=>{
                this.articles = data;
            })
        },
        editArticle(articlex){
            this.form = {...articlex};
        },
        deleteArticle(articlex){
            if(confirm('are you sure you want to delete this article?')){
                axios.post('/delete-articles', articlex).then(({data})=>{
                    this.getter();
                })
            }
        }
    }
})
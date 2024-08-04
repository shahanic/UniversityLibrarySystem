// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineStore } from 'pinia';
import axios from 'axios';
import AddArticle from '../Modals/AddArticle.vue';

export const articlesStore = defineStore('articles', {
  state: () => ({
    currentArticle: null,
    newArticle: {
      title: '',
      abstract: '',
      slug: '',
      content: '',
      status: '',
      gallery_id: '', 
      date: new Date().toISOString().split('T')[0],
    },
    articles: [],
    adding: false,
    editing: false,
    preview: false,
    previewArticle: null,
  }),

  actions: {
    generateSlug(title) { 
      return title.toLowerCase().replace(/\s+/g, '-'); 
  },
  
    cancel(){
      this.editing = false;
      this.adding = false;    
      this.preview = false;
  },
    previewContent(id){
      this.preview = true;
      axios.post(`/edit-article/${id}`)
        .then((response) =>{
          this.previewArticle = {
            title: response.data[0].title,
            content: response.data[0].content
          };

        })
        .catch((error) => {
          console.error('Error fetching article data:', error);
        })
  },

    addArticle(article){
      this.newArticle = article;
      this.adding = true;
    },
    addNewArticle(){
      this.newArticle.slug = this.generateSlug(this.newArticle.title);
      if (this.newArticle){
        axios.post('/save-article', this.newArticle)
        .then(() =>{
          alert('Content saved successfully!');
          this.adding = false;
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
      }
    },



    editArticle(article){
      console.log(article); 
      this.currentArticle = article;
      this.editing = true;
    },
    editArticleData(id){
        axios.post(`/edit-article/${id}`)
        .then((response) =>{
          this.currentPage = response.data[0]||null;
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
    },

    save(){
      this.currentArticle.slug = this.generateSlug(this.currentArticle.title);
      if (this.currentArticle){
        axios.post('/save-article', this.currentArticle)
        .then(() =>{
          alert('Content saved successfully!');
          this.editing = false;
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
      }
    },

    fetchArticlesData(){
      this.$reset();
      axios.post('/get-articles')
      .then((response) => {
        this.articles = response.data;
        
      })
      .catch((error) => {
        console.error('Error fetching articles:', error);

      })
    },

    deleteArticle(id){
      if (!id) return;
      if (confirm('Are you sure you want to delete this page?')){
      axios.post('/delete-article', { id })
      .then(() => {
        this.$reset();
        this.fetchArticlesData();
        alert('Article deleted successfully!');
      })
      .catch((error) => {
        console.error('Error deleting article:', error);
        alert('Failed to delete article.');
      })
    }
    },

    async fetchArticleData(id){
        try {
            const response = await axios.get(`/get-article/${id}`);
            // Assuming the response data is an object for a single article
            this.currentArticle = response.data[0]||null;

        } catch (error) {
            console.error('Error fetching article data:', error);
        }
    }

  },
});

<template>
    <suggestions
            :options="searchOptions"
            :onItemSelected="onSearchItemSelected"
            :onInputChange="onInputChange">

        <template v-slot:default="slotProps">
            <div class="px-4">
                <div class="flex gap-3">
                    <div class="flex self-center">
                        <img class="w-11 rounded-full" :src="slotProps.item.picture"/>
                    </div>
                    <div class="flex self-center">
                        <div>
                            <h5 class="font-semibold mb-0">
                                {{slotProps.item.name}}
                            </h5>
                        <span>{{ slotProps.item.degree }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </template>
    </suggestions>

</template>

<script>
    import Suggestions from './Suggestions.vue';
    export default {
        name: "StudentSearch",
        components: {Suggestions},
        data(){
            return{
                selectedSearchItem: null,
                searchOptions: {
                    inputClass: 'form-input rounded w-full border-gray-300',
                    placeholder: 'Enter Member\'s ID or name'
                },
            }
        },
        methods: {
            onInputChange (query) {
                if (query.trim().length < 3) {
                    return null
                }

                const url = '/v2/students/student-map?term='+query;

                return new Promise(resolve => {
                    axios.get(url).then(({data}) => {
                        const  items = [];
                        console.log(data);
                        data.forEach((item) => {
                            if (item) {
                                items.push(item)
                            }
                        });
                        resolve(items)
                    });
                });
            },
            onSearchItemSelected (data) {
                this.$router.push(`/v2/students/${data.student_id}/view`);
            },

        },

    }
</script>

<style scoped>

</style>

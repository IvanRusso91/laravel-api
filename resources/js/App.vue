<template>
    <div class="box-x">

        <h1>i miei post!</h1>

        <div class="container-r">
            <div class="box" v-for="post in posts" :key="post.id">
                <h3>{{post.id}}. {{post.title}}</h3>
                <p>{{post.content}}</p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'App',

    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts',
            posts: [],
        }
    },

    mounted(){
        this.getApi();
    },

    methods:{
        getApi(){
            axios.get(this.apiUrl).then(r =>{
                this.posts = r.data;
            })
        }
    },
}
</script>

<style>

</style>

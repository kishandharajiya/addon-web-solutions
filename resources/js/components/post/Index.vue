<template>
    <div class="container">
        <div class="loader" v-if="loader"></div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Post List</h3>
                        <router-link :to='{ name: "posts.create"}' class="btn btn-primary">Create Post</router-link>
                    </div>
                    <div class="form-group col-12">
                        <label for="email" class="font-weight-bold">Search</label>
                        <input type="text" v-model="search" @keyup="searchInput">
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th v-if="user.role == 'admin'">Created By</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in postList" :key="post.id">
                                <td>{{ post.id }}</td>
                                <th v-if="user.role == 'admin'">{{ post.user.name }}</th>
                                <td>{{ post.title }}</td>
                                <td>{{ post.body }}</td>
                                <td>
                                    <router-link :to='{ name: "post.edit", params: { id: post.id } }'
                                        class="btn">Edit</router-link>
                                    <button class="btn" @click="deleteItem(post)">Delete</button>
                                </td>
                            </tr>
                            <tr v-if="postList.length == 0">
                                No post found
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "index",
    data() {
        return {
            user: this.$store.state.auth.user,
            processing: false,
            postList: [],
            loader: false,
            search:""
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        searchInput() {
            if (this.timer) {
                clearTimeout(this.timer);
            }
            this.timer = setTimeout(this.getPosts, 500); // Adjust delay as needed
        },
        async getPosts() {
            this.loader = true
            await axios.get('/api/post/list?search=' + this.search).then(({ data }) => {
                setTimeout(() => {
                    this.postList = data.result.posts.data; // Update items with fetched data
                    this.loader = false;
                }, 1000);

            }).finally(() => {
                this.loader = false
            })
        },
        async deleteItem(item) {
            if (confirm('Are you sure you want to delete this post?')) {
                this.loader = true
                await axios.post('/api/post/delete', item).then(({ data }) => {
                    this.loader = false;
                    this.postList = this.postList.filter(post => post.id !== item.id);
                }).catch(({ response }) => {
                    if (!response)
                        return
                    this.validationErrors = response.data.message
                }).finally(() => {
                    this.loader = false
                })
            }
        },
    }
}
</script>
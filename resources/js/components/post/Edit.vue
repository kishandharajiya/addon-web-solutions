<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Edit Post</h1>
                        <hr />
                        <form action="javascript:void(0)" @submit="updatePost" class="row" method="post">
                            <div class="col-12" v-if="validationErrors.length">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li>{{ validationErrors }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="name" class="font-weight-bold">Title</label>
                                <input type="text" name="name" v-model="post.title" id="title" placeholder="Enter title"
                                    class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="email" class="font-weight-bold">Body</label>
                                <textarea name="body" v-model="post.body" id="body" placeholder="Enter body"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" :disabled="processing" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Edit" }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'user.edit',
    data() {
        return {
            post: {
                id: "",
                title: "",
                body: "",
            },
            validationErrors: {},
            processing: false
        }
    },
    mounted() {
        this.editPost();
    },
    methods: {
        async editPost() {
            this.processing = true
            await axios.get('/api/post/edit/' + this.$route.params.id).then(({ data }) => {
                this.validationErrors = {}
                this.post = data.result.post
            }).catch(({ response }) => {
                this.validationErrors = response.data.message
            }).finally(() => {
                this.processing = false
            })
        },
        async updatePost() {
            this.processing = true
            await axios.put('/api/post/update', this.post).then(({ data }) => {
                this.$router.push({ name: "posts" });
            }).catch(({ response }) => {
                this.validationErrors = response.data.message
            }).finally(() => {
                this.processing = false
            })
        },
    }
}
</script>
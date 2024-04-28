<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Edit User</h1>
                        <hr />
                        <form action="javascript:void(0)" @submit="updateUser" class="row" method="post">
                            <div class="col-12" v-if="validationErrors.length">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li>{{ validationErrors }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" v-model="user.name" id="name" placeholder="Enter name"
                                    class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" name="email" v-model="user.email" id="email"
                                    placeholder="Enter Email" class="form-control">
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
            user: {
                id: "",
                name: "",
                email: "",
            },
            validationErrors: {},
            processing: false
        }
    },
    mounted() {
        this.editUser();
    },
    methods: {
        async editUser() {
            this.processing = true
            await axios.get('/api/user/edit/' + this.$route.params.id).then(({ data }) => {
                this.validationErrors = {}
                this.user = data.result.user
            }).catch(({ response }) => {
                this.validationErrors = response.data.message
            }).finally(() => {
                this.processing = false
            }) 
        },
        async updateUser() {
            this.processing = true
            await axios.put('/api/user/update', this.user).then(({ data }) => {
                this.$router.push({ name: "users" });
            }).catch(({ response }) => {
                this.validationErrors = response.data.message
            }).finally(() => {
                this.processing = false
            })
        },
    }
}
</script>
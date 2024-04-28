<template>
    <div class="container">
        <div class="loader" v-if="loader"></div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>User List</h3>
                    </div>
                    <div class="form-group col-12">
                        <label for="email" class="font-weight-bold">Search</label>
                        <input type="text" v-model="search" @keyup="searchInput">
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in userList" :key="user.id">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <router-link :to='{ name: "user.edit", params: { id: user.id } }'
                                        class="btn">Edit</router-link>
                                    <button class="btn" @click="deleteItem(user)">Delete</button>
                                </td>
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
            userList: [],
            search: "",
            loader: false,
            userHeader: [{ key: "name", label: "Full Name" }, { key: "email", label: "Email" }]
        }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        searchInput() {
            if (this.timer) {
                clearTimeout(this.timer);
            }
            this.timer = setTimeout(this.getUsers, 500); // Adjust delay as needed
        },
        async getUsers() {
            this.loader = true
            await axios.get('/api/user/list?search='+this.search).then(({ data }) => {
                setTimeout(() => {
                    this.userList = data.result.users.data; // Update items with fetched data
                    this.loader = false;
                }, 1000);
            }).finally(() => {
                this.loader = false
            })
        },
        async deleteItem(item) {
            if (confirm('Are you sure you want to delete this user?')) {
                this.loader = true
                await axios.post('/api/user/delete', item).then(({ data }) => {
                    this.loader = false;
                    this.userList = this.userList.filter(user => user.id !== item.id);
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
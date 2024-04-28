<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand"
                    href="https://techvblogs.com/blog/spa-authentication-laravel-9-sanctum-vue3-vite"
                    target="_blank">Laravel Vue {{ loader }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <router-link :to="{ name: 'dashboard' }" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item" v-if="user.role == 'admin'">
                            <router-link :to="{ name: 'users' }" class="nav-link">User List</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'posts' }" :active-class="isActive('/posts')"
                                active-class="active" class="nav-link">Post List</router-link>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ user.name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="mt-3">
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    name: "default-layout",
    data() {
        return {
            user: this.$store.getters.user,
        }
    },
    methods: {
        isActive(path) {
            // Check if the current route starts with the provided path
            return this.$route.path.startsWith(path);
        },
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post('/logout').then(({ data }) => {
                this.$store.dispatch('removeUser')
                this.$router.push({ name: "login" })
            })
        }
    }
}
</script>
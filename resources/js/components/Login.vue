<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Login</h1>
                        <hr/>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="col-12" v-if="validationErrors.length">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li >{{ validationErrors }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" v-model="auth.email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" v-model="auth.password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Login" }}
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label>Don't have an account? <router-link :to="{name:'register'}">Register Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, useStore } from 'vuex'
import { useRouter } from 'vue-router'
export default {
    name:"login",
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            validationErrors:{},
            processing:false,
            store:useStore()
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async login(){
            this.processing = true
            await axios.post('/api/auth/login', this.auth).then(({ data }) => {
                console.log(data);
                this.$store.dispatch('setUser',data.result);
                this.$router.push({name:"dashboard"})
            }).catch(({response})=>{
                if(!response)
                    return
                if(response.status===422){
                    this.validationErrors = response.data.message
                }else{
                    this.validationErrors = response.data.message
                }
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>
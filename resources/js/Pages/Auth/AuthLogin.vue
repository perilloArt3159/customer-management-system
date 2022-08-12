<script lang="ts">
import { defineAsyncComponent } from "vue";

export default 
{
    layout: defineAsyncComponent(() => import('@/Layouts/LayoutAuth.vue'))
}

</script>

<script setup lang="ts">

import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm(
    {
        username: null,
        password: null,
    }
); 

function submit()
{
    form.clearErrors();

    form.post(
        route('login.authenticate'),
        {
            onSuccess: () => 
            {
                //...
            },
            onError: () => 
            {
                //...
            }
        }
    )
}


</script>

<style lang="scss">

#card-form 
{
    width    : 100%;
    max-width: 500px;
    margin   : 1em auto;

    .card-header
    {
        letter-spacing: 2px;
        border-bottom : 1px dashed skyblue;
        padding-bottom: 6px;
    } 
}

</style>

<template>
    <div id="card-form" class="card shadow">
        <div class="card-header text-uppercase text-primary fs-5 fw-bolder text-center bg-white">
            Login
        </div>
        <div class="card-body">
            <form @submit.prevent="submit">
                <div class="form-row">
                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-primary">
                                    <i class="bi-person-fill fs-5 text-white"></i>
                                </div>
                            </div>
                            <input v-model="form.username" type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-primary">
                                    <i class="bi-key-fill fs-5 text-white"></i>
                                </div>
                            </div>
                            <input v-model="form.password" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary fw-bolder mt-1" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
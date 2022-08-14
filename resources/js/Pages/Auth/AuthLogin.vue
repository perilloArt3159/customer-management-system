<script lang="ts">

import { defineAsyncComponent } from "vue";

export default 
{
    layout: defineAsyncComponent(() => import('@/Layouts/LayoutAuth.vue'))
}

</script>

<script setup lang="ts">

import { ref, defineProps } from "vue";
import type { Ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

interface Props 
{
    errors?: Object | null,
}

const props = defineProps<Props>();

const form = useForm(
    {
        name    : 'admin',
        password: 'admin',
    }
); 

const wasFormValidated: Ref<boolean> = ref(false); 

const submit = () => 
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
            },
        }
    ); 

    wasFormValidated.value = true; 
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
            <form @submit.prevent="submit" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-text  bg-primary">
                                <i class="bi-person-fill fs-5 text-white"></i>
                            </div>
                            <input 
                                v-model="form.name" 
                                type="text" 
                                id="name"
                                placeholder="Username" 
                                :class="{
                                    'form-control' : true, 
                                    'is-valid'     : wasFormValidated && errors?.name == null, 
                                    'is-invalid'   : wasFormValidated && errors?.name != null 
                                }" 
                                required
                            >
                            <div class="valid-feedback">
                                <small>
                                    <i class="bi-check-circle"></i> Looks Good! 
                                </small>
                            </div>
                            <div class="invalid-feedback">
                                <small>
                                    <i class="bi-exclamation-circle"></i> {{ errors?.name }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-text  bg-primary">
                                <i class="bi-key-fill fs-5 text-white"></i>
                            </div>
                            <input 
                                v-model="form.password" 
                                id="password"
                                type="password" 
                                :class="{
                                    'form-control' : true, 
                                    'is-valid'     : wasFormValidated && errors?.password == null, 
                                    'is-invalid'   : wasFormValidated && errors?.password != null 
                                }"  
                                placeholder="Password"
                            >
                            <div class="valid-feedback">
                                <small>
                                    <i class="bi-check-circle"></i> Looks Good! 
                                </small>
                            </div>
                            <div class="invalid-feedback">
                                <small>
                                    <i class="bi-exclamation-circle"></i> {{ errors?.password }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button 
                        class="btn btn-primary fw-bolder mt-1" 
                        type="submit"
                        :disabled="form.processing"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
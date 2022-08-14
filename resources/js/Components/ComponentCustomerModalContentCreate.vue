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
        name          : null,
        contact_person: null,
        address       : null,
        email         : null,
        contact_number: null,
        tin_number    : null,
        type          : null,
    }
);

const wasFormValidated: Ref<boolean> = ref(false);

const submit = () => 
{
    form.clearErrors();

    form.post(
        route('customers.store'),
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

<style scoped lang="scss">

</style>

<template>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form @submit.prevent="submit" class="needs-validation" novalidate>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Customer Information</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="form-group row my-3">
                            <label for="inputCustomerName" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1">*</span>
                                Customer Name:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-person-fill fs-6 text-white"></i>
                                    </div>
                                    <input 
                                        v-model="form.name"
                                        type="text" 
                                        class="form-control" 
                                        id="inputCustomerName" 
                                        placeholder="Name"
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
                        </div>
                        <div class="form-group row my-3">
                            <label for="inputContactPerson" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1"></span>
                                Contact Person:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-people-fill fs-6 text-white"></i>
                                    </div>
                                    <input
                                        v-model="form.contact_person" 
                                        type="text" 
                                        class="form-control" 
                                        id="inputContactPerson"
                                        placeholder="Contact Person"
                                    >
                                    <div class="valid-feedback">
                                        <small>
                                            <i class="bi-check-circle"></i> Looks Good!
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        <small>
                                            <i class="bi-exclamation-circle"></i> {{ errors?.contact_person }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="inputAddress" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1">*</span>
                                Address:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-house-door-fill fs-6 text-white"></i>
                                    </div>
                                    <textarea
                                        v-model="form.address" 
                                        type="text" 
                                        class="form-control" 
                                        id="inputAddress" 
                                        placeholder="Address"
                                        required
                                    >
                                    </textarea>
                                    <div class="valid-feedback">
                                        <small>
                                            <i class="bi-check-circle"></i> Looks Good!
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        <small>
                                            <i class="bi-exclamation-circle"></i> {{ errors?.address }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="inputEmail" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1"></span>
                                Email Address:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-envelope-fill fs-6 text-white"></i>
                                    </div>
                                    <input
                                        v-model="form.email" 
                                        type="email" 
                                        class="form-control" 
                                        id="inputEmail" 
                                        placeholder="Email"
                                    >
                                    <div class="valid-feedback">
                                        <small>
                                            <i class="bi-check-circle"></i> Looks Good!
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        <small>
                                            <i class="bi-exclamation-circle"></i> {{ errors?.email }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="inputPhone" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1"></span>
                                Contact No:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-phone-fill fs-6 text-white"></i>
                                    </div>
                                    <input
                                        v-model="form.contact_number" 
                                        type="text" 
                                        class="form-control" 
                                        id="inputPhone" 
                                        placeholder="Phone"
                                    >
                                    <div class="valid-feedback">
                                        <small>
                                            <i class="bi-check-circle"></i> Looks Good!
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        <small>
                                            <i class="bi-exclamation-circle"></i> {{ errors?.contact_number }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="inputTin" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1"></span>
                                TIN:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-file-text-fill fs-6 text-white"></i>
                                    </div>
                                    <input
                                        v-model="form.tin_number" 
                                        type="text" 
                                        class="form-control" 
                                        id="inputTin" 
                                        placeholder="TIN"
                                    >
                                    <div class="valid-feedback">
                                        <small>
                                            <i class="bi-check-circle"></i> Looks Good!
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        <small>
                                            <i class="bi-exclamation-circle"></i> {{ errors?.tin_number }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="inputTin" class="col-md-3 col-form-label fw-bold">
                                <span class="text-danger me-1"></span>
                                Customer Type:
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-text bg-primary">
                                        <i class="bi bi-question-circle-fill fs-6 text-white"></i>
                                    </div>
                                    <select 
                                        class="form-select" 
                                        aria-label="Default select example"
                                    >
                                        <option value="NONE" selected>None</option>
                                        <option value="WALK-IN">Walk-In</option>
                                        <option value="ONLINE">Online</option>
                                    </select>
                                    <div class="valid-feedback">
                                        <small>
                                            <i class="bi-check-circle"></i> Looks Good!
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        <small>
                                            <i class="bi-exclamation-circle"></i> {{ errors?.tin_number }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>